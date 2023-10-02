#include <SoftwareSerial.h>
#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>
#include <WiFiClientSecureBearSSL.h>
#include <SPI.h>
#include <Wire.h>
#include <Adafruit_GFX.h>
#include <Adafruit_SSD1306.h>
#include <TinyGPS++.h>
#include "ESPAsyncWebServer.h"

TinyGPSPlus gps;
SoftwareSerial SerialGPS(D7, D8);
// const char* ssid = "P99mmmm";
// const char* password = "053090738";
const char* ssid = "UFI-231987";
const char* password = "12345678";
const char* serverName = "https://dustdetector.net/post2_data.php";
String apiKeyValue = "tPmAT5Ab3j7F9";
SoftwareSerial mySerial(D5, D6);  // TX, RX
int buttonPin = D3;               // กำหนดขา D3 เป็นขาสำหรับตรวจสอบการกดปุ่ม
int prevState = HIGH;             // กำหนดค่าเริ่มต้นของ prevState เป็น HIGH
unsigned int pm1 = 0;
unsigned int pm2_5 = 0;
unsigned int pm10 = 0;
unsigned int aqi = 0;  // ตัวแปรเก็บค่า AQI
float Latitude, Longitude;
int year, month, date, hour, minute, second;
String DateString, TimeString, LatitudeString, LongitudeString;
#define OLED_RESET 16
Adafruit_SSD1306 display(128, 64, &Wire, -1);
const int MAX_HISTORY = 10;  // จำนวนค่าพิกัดย้อนหลังที่ต้องการเก็บ
float latitudeHistory[MAX_HISTORY];
float longitudeHistory[MAX_HISTORY];
int historyIndex = 0;
AsyncWebServer server(80);

void setup() {
  Serial.begin(9600);
  SerialGPS.begin(9600);
  mySerial.begin(9600);
  pinMode(buttonPin, INPUT);  // กำหนดขา buttonPin เป็นขาแบบ INPUT
  display.begin(SSD1306_SWITCHCAPVCC, 0x3C);
  display.clearDisplay();
  display.setTextSize(2);
  display.setTextColor(WHITE);
  display.setCursor(13, 10);
  display.println("Welcome ");
  display.display();
  Serial.println();
  Serial.print("Connecting");
  WiFi.begin(ssid, password);
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
  Serial.println("");
  Serial.println("WiFi connected");
  IPAddress IP = WiFi.softAPIP();
  Serial.print("AP IP address: ");
  Serial.println(IP);

  // server.on("/aqi", HTTP_GET, [](AsyncWebServerRequest *request){
  //   request->send_P(200, "text/plain", readPres().c_str());
  // });



  server.begin();
}

void loop() {
  int index = 0;
  char value;
  char previousValue;

  if (SerialGPS.available() > 0) {
    while (SerialGPS.available()) {
      if (gps.encode(SerialGPS.read())) {
        if (gps.location.isValid()) {
          Latitude = gps.location.lat();
          Longitude = gps.location.lng();
          LatitudeString = String(Latitude, 6);
          LongitudeString = String(Longitude, 6);
          // Serial.println(LatitudeString);
          // Serial.println(LongitudeString);

          latitudeHistory[historyIndex] = Latitude;
          longitudeHistory[historyIndex] = Longitude;
          historyIndex = (historyIndex + 1) % MAX_HISTORY;
        } else {
          Serial.println("Location not available");
        }
      }
    }
  }

  // แสดงค่าพิกัดที่เก็บไว้ล่าสุด
  float latestLatitude = latitudeHistory[(historyIndex + MAX_HISTORY - 1) % MAX_HISTORY];
  float latestLongitude = longitudeHistory[(historyIndex + MAX_HISTORY - 1) % MAX_HISTORY];
  Serial.println("Latest Latitude: " + String(latestLatitude, 15));
  Serial.println("Latest Longitude: " + String(latestLongitude, 15));
  // server.on("/lat", HTTP_GET, [](AsyncWebServerRequest *request){
  //     request->send_P(200, "text/plain", float(latestLatitude, 6) );
  //   });
  //   server.on("/long", HTTP_GET, [](AsyncWebServerRequest *request){
  //     request->send_P(200, "text/plain", float(latestLongitude, 6));
  //   });
  // ตอนใช้งานค่าพิกัดย้อนหลัง
  for (int i = 0; i < MAX_HISTORY; i++) {
    float previousLatitude = latitudeHistory[i];
    float previousLongitude = longitudeHistory[i];
    // ทำสิ่งที่ต้องการกับค่าพิกัดย้อนหลังที่ i
  }
  while (mySerial.available()) {
    value = mySerial.read();
    if ((index == 0 && value != 0x42) || (index == 1 && value != 0x4d)) {
      Serial.println("Cannot find the data header.");
      break;
    }

    if (index == 4 || index == 6 || index == 8 || index == 10 || index == 12 || index == 14) {
      previousValue = value;
    } else if (index == 5) {
      pm1 = 256 * previousValue + value;
      Serial.print("{ ");
      Serial.print("\"pm1\": ");
      Serial.print(pm1);
      Serial.print(" ug/m3");
      Serial.print(", ");

    } else if (index == 7) {
      pm2_5 = 256 * previousValue + value;
      Serial.print("\"pm2_5\": ");
      Serial.print(pm2_5);
      Serial.print(" ug/m3");
      Serial.print(", ");

    } else if (index == 9) {
      pm10 = 256 * previousValue + value;
      Serial.print("\"pm10\": ");
      Serial.print(pm10);
      Serial.print(" ug/m3");
      // เรียกใช้ฟังก์ชันคำนวณ AQI
      aqi = calculateAQI(pm2_5, pm10);
      Serial.print(", ");
      Serial.print("\"aqi\": ");
      Serial.print(aqi);


    } else if (index > 15) {
      break;
    }
    display.clearDisplay();



    display.setTextSize(1);
    display.setCursor(0, 20);
    display.print("Latitude: ");
    display.println(latestLatitude, 6);

    display.setTextSize(1);
    display.setCursor(0, 30);
    display.print("Longitude: ");
    display.println(latestLongitude, 6);
    display.setTextSize(1);
    display.setCursor(0, 40);
    display.print("PM2.5: ");
    display.print(pm2_5);
    display.println(" ug/m3");

    display.setTextSize(1);
    display.setCursor(0, 50);
    display.print("AQI: ");
    display.print(aqi);
    display.display();

    index++;
  }
  while (mySerial.available()) mySerial.read();
  Serial.println(" }");
  // delay(500);

  if (WiFi.status() == WL_CONNECTED) {
    std::unique_ptr<BearSSL::WiFiClientSecure> client(new BearSSL::WiFiClientSecure);
    client->setInsecure();
    int val = digitalRead(buttonPin);
    if (val == LOW && prevState != LOW) {
      HTTPClient https;
      https.begin(*client, serverName);
      https.addHeader("Content-Type", "application/x-www-form-urlencoded");

      String httpRequestData = "api_key=" + apiKeyValue + "&lat=" + String(latestLatitude, 15) + "&lng=" + String(latestLongitude, 15) + "&pm1=" + String(pm1) + "&pm25=" + String(pm2_5) + "&pm10=" + String(pm10) + "&aqi=" + String(aqi);


      Serial.print("httpRequestData: ");
      Serial.println(httpRequestData);

      int httpResponseCode = https.POST(httpRequestData);

      if (httpResponseCode > 0) {
        Serial.print("HTTP Response code: ");
        Serial.println(httpResponseCode);
      } else {
        Serial.print("Error code: ");
        Serial.println(httpResponseCode);
      }

      https.end();
      Serial.println("Press Button");
      display.clearDisplay();
      display.setTextSize(1);
      display.setCursor(30, 5);
      display.println("Send Data");
      display.setCursor(30, 15);

      display.println("Tanks You");

      display.display();

      delay(500);
      prevState = val;
    }
    prevState = val;

  } else {
    Serial.println("WiFi Disconnected");
  }
  delay(500);
}

unsigned int calculateAQI(unsigned int pm25, unsigned int pm10) {
  unsigned int aqi_pm25 = 0;
  unsigned int aqi_pm10 = 0;

  // สูตรคำนวณ AQI สำหรับ PM2.5
  if (pm25 > 0 && pm25 <= 12) {
    aqi_pm25 = map(pm25, 0, 12, 0, 50);
  } else if (pm25 > 12 && pm25 <= 35.4) {
    aqi_pm25 = map(pm25, 12.1, 35.4, 51, 100);
  } else if (pm25 > 35.4 && pm25 <= 55.4) {
    aqi_pm25 = map(pm25, 35.5, 55.4, 101, 150);
  } else if (pm25 > 55.4 && pm25 <= 150.4) {
    aqi_pm25 = map(pm25, 55.5, 150.4, 151, 200);
  } else if (pm25 > 150.4 && pm25 <= 250.4) {
    aqi_pm25 = map(pm25, 150.5, 250.4, 201, 300);
  } else if (pm25 > 250.4 && pm25 <= 350.4) {
    aqi_pm25 = map(pm25, 250.5, 350.4, 301, 400);
  } else if (pm25 > 350.4 && pm25 <= 500.4) {
    aqi_pm25 = map(pm25, 350.5, 500.4, 401, 500);
  } else if (pm25 > 500.4) {
    aqi_pm25 = 500;
  }

  // สูตรคำนวณ AQI สำหรับ PM10
  if (pm10 > 0 && pm10 <= 54) {
    aqi_pm10 = map(pm10, 0, 54, 0, 50);
  } else if (pm10 > 54 && pm10 <= 154) {
    aqi_pm10 = map(pm10, 55, 154, 51, 100);
  } else if (pm10 > 154 && pm10 <= 254) {
    aqi_pm10 = map(pm10, 155, 254, 101, 150);
  } else if (pm10 > 254 && pm10 <= 354) {
    aqi_pm10 = map(pm10, 255, 354, 151, 200);
  } else if (pm10 > 354 && pm10 <= 424) {
    aqi_pm10 = map(pm10, 355, 424, 201, 300);
  } else if (pm10 > 424 && pm10 <= 504) {
    aqi_pm10 = map(pm10, 425, 504, 301, 400);
  } else if (pm10 > 504 && pm10 <= 604) {
    aqi_pm10 = map(pm10, 505, 604, 401, 500);
  } else if (pm10 > 604) {
    aqi_pm10 = 500;
  }

  // เลือกค่า AQI ที่สูงสุดจาก PM2.5 และ PM10
  unsigned int aqi = max(aqi_pm25, aqi_pm10);
  return aqi;
}
