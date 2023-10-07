#include <WiFi.h>
#include <HTTPClient.h>
#include <DHT.h>
#define DHTPIN 4
#define DHTTYPE DHT11

DHT dht(DHTPIN, DHTTYPE);

const char* ssid = "TS2_YouGame";
const char* password = "12343212";

const String controller_id = "5";
const String controller_password = "sxfcgj";

String serverName = "http://zaskamilma.temp.swtest.ru/test.php";

unsigned long lastTime = 0;
unsigned long timerDelay = 5000;

void setup() {
  dht.begin();
  Serial.begin(115200);

  WiFi.begin(ssid, password);
  Serial.println("Connecting");
  while(WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
  Serial.println("");
  Serial.print("Connected to WiFi network with IP Address: ");
  Serial.println(WiFi.localIP());
 
  Serial.println("Timer set to 5 seconds (timerDelay variable), it will take 5 seconds before publishing the first reading.");
}

void loop() {
  delay(2000);
  float humidity = dht.readHumidity();
  float temperature = dht.readTemperature();

  if ((millis() - lastTime) > timerDelay) {
    if(WiFi.status()== WL_CONNECTED){
      WiFiClient client;
      HTTPClient http;
    
      http.begin(client, serverName);
      
      http.addHeader("Content-Type", "application/json");
      String data = "{\\\"temper\\\":\\\"" + String(temperature, 2) + "\\\", \\\"humidity\\\":\\\"" + String(humidity, 2) + "\\\"}";
      String resp = "{\"id\":\"" + controller_id + "\", \"password\":\"" + controller_password + "\", \"data\":\"" + data + "\"}";
      // Serial.println(resp);
      int httpResponseCode = http.POST(resp);
     
      Serial.print("HTTP Response code: ");
      Serial.println(httpResponseCode);

      http.end();
    }
    else {
      Serial.println("WiFi Disconnected");
    }
    lastTime = millis();
  }
}