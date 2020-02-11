#include <LiquidCrystal_I2C.h>
#include <Wire.h>
#include <SPI.h>
#include <SD.h>
#include <ESP8266WiFi.h>
#include <math.h>
#include "RTClib.h"

RTC_DS3231 rtc;

char daysOfTheWeek[7][12] = {"Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"};

const char* ssid     = "azulgranas_id";
const char* password = "30297208";
const char* host = "spirulinaiot.000webhostapp.com";

File myFile;
int pbstart,pbstop,pbcal;
LiquidCrystal_I2C lcd(0x27, 16, 2); //0x3F

void setup() {
  pinMode(D3, INPUT);
  pinMode(D4, INPUT);
 
  lcd.begin();
  Serial.begin(115200);
//Start initializing uSD card
  if (!SD.begin(D8)) {
    Serial.println("initialization failed!");
    while (1);
  }
  Serial.println("initialization done.");

//End initializing uSD card
// Init RTC
#ifndef ESP8266
  while (!Serial); // for Leonardo/Micro/Zero
#endif

  delay(3000); // wait for console opening

  if (! rtc.begin()) {
    Serial.println("Couldn't find RTC");
    while (1);
  }

  if (rtc.lostPower()) {
    Serial.println("RTC lost power, lets set the time!");
    // following line sets the RTC to the date & time this sketch was compiled
    rtc.adjust(DateTime(F(__DATE__), F(__TIME__)));
    // This line sets the RTC with an explicit date & time, for example to set
    // January 21, 2014 at 3am you would call:
    //rtc.adjust(DateTime(2020, 1, 8, 16, 51, 0));
  }
//End init RTC
//Start connecting to WiFi
  Serial.print("Connecting to ");
  Serial.println(ssid);

  WiFi.begin(ssid, password); 
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
 
  Serial.println("");
  Serial.println("WiFi connected"); 
//End connecting to WiFi
}
void loop() {
  DateTime now = rtc.now();
  String dates = String(now.year(),DEC)+"/"+String(now.month(),DEC)+"/"+String(now.day(),DEC);
  String times = String(now.hour(),DEC)+":"+String(now.minute(),DEC)+":"+String(now.second(),DEC);
  
  int pbst = digitalRead(D3);
  int pbcal = digitalRead(D4);
  float sensor = analogRead(A0); 
  float volt = (sensor/1024)*5.0;
  float ints = 10000-volt*2000.0; 
  float trans = ints / 6000;
  float adso = log10(trans);
  
  if (times=="1:0:0" || times=="2:0:0" || times=="3:0:0" || times=="4:0:0" || times=="5:0:0" || times=="6:0:0" || 
       times=="7:0:0" || times=="8:0:0" || times=="9:0:0" || times=="10:0:0" || times=="11:0:0" || times=="12:0:0" ||
       times=="13:0:0" || times=="14:0:0" || times=="15:0:0" || times=="16:0:0" || times=="17:0:0" || times=="18:0:0" ||
       times=="19:0:0" || times=="20:0:0" || times=="21:0:0" || times=="22:0:0" || times=="23:0:0" || times=="0:0:0"){
            Serial.println(dates+" "+times);
            Serial.println("Pembacaan sensor : " + String(sensor));
          //Start write data to uSD
            myFile = SD.open("dataspirulinaiot1.txt", FILE_WRITE);
          
            if(myFile) {
              Serial.print("Writing to dataspirulinaiot1.txt...");
              myFile.println(String(dates)+","+String(times)+","+String(sensor));
              // close the file:
              myFile.close();
              Serial.println("done.");
            } else {
              // if the file didn't open, print an error:
              Serial.println("error opening spirulinaiot.txt");
            }
          //End of write data to uSD
          
          
          //Start sending data to MySQL database
            Serial.print("connecting to ");
            Serial.println(host);
          
            WiFiClient client;
            const int httpPort = 80;
            if (!client.connect(host, httpPort)) {
              Serial.println("connection failed");
              return;
            }
          
            String url = "/api/insert.php?dates=" + String(dates) + 
                         "&times=" + String(times) + "&volt=" + String(volt) + 
                         "&ints="+ String(ints) +"&trans="+ String(trans) + 
                         "&adso=" + String(adso);
            Serial.print("Requesting URL: ");
            Serial.println(url);
            
            client.print(String("GET ") + url + " HTTP/1.1\r\n" +
                         "Host: " + host + "\r\n" + 
                         "Connection: close\r\n\r\n");
            delay(500);
            
          //  while(client.available()){
          //    String line = client.readStringUntil('\r');
          //    Serial.print(line);
          //  }
            
            Serial.println();
            Serial.println("closing connection");
          //End of sending data to MySQL database
            Serial.println();
            delay(5000);}
 else{
            Serial.println(dates+" "+times);
            Serial.println("Pembacaan sensor : " + String(sensor));
           //Start show data to LCD
            lcd.setCursor(0, 0);
            lcd.print("Phore-algae");
            lcd.setCursor(0, 1);
            lcd.print("Data : "+ String(ints) + " lux");
            delay(1000);
          //End of show data to LCD
 }
  
}
