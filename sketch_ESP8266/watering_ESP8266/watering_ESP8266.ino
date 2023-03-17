#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>
#include <WiFiClient.h>
#include <SoftwareSerial.h>

const char* ssid = "HOME";
const char* password = "14639214";
const char* host = "";//host ip
const uint16_t port = 80;
int relay = 5;
int led = 2;

//const byte espRx = 5;
//const byte espTx = 4;
//SoftwareSerial SerialEsp(espRx,espTx);

//Rx msg
//bool received = false;
//String receivedMsg;

String s_humedad;
String s_motor;
const byte numVars = 2;
String controlledVars[] = {s_humedad,s_motor};

//variables
int motor = 0;
int humedad = 40;

void SendDataToHost(){
  Serial.print(">>>>>>> conecting to ");
  Serial.print(host);
  Serial.print(':');
  Serial.println(port);

  WiFiClient client;
  if (!client.connect(host, port)){
    Serial.println("connection failed");
    delay(5000);
    return;
  }
  String query = "esp8266/save.php?motor=";
  query +=  motor;
  query += "&humedad=";
  query += humedad;
  Serial.println(query);

  Serial.println("[Sending request]");
  client.print(String("GET /") + query + " HTTP/1.1\r\n" +
             "Host: " + host + "\r\n" +
             "Connection: close\r\n" +
             "\r\n"
            );
  //wait for data
  unsigned long timeout = millis();
  while (client.available() == 0){
    if (millis() - timeout > 5000){
      Serial.println(">>> Client Timeout !");
      client.stop();
      delay(3000);
      return;
    }
  }
  // read reply
  Serial.println("Receiving from server");
  String msg;
  while (client.available()){
    char ch = static_cast<char>(client.read());
    Serial.print(ch);
    msg += ch;
  }
  Serial.println();
  if (msg.indexOf("guardado correcto") != -1){//respuesta script php
    Serial.println("Data saved");
  }
  else{
    Serial.println("could not save data");
  }
  //close connection
  Serial.println();
  Serial.println(">>>>>>>><Closing connection");
  Serial.println();
  client.stop();
}


void setup() {
  pinMode(relay, OUTPUT);
  Serial.begin(9600);
  //SerialEsp.begin((9600));
  pinMode(led, OUTPUT);
  WiFi.begin(ssid, password);
  delay(500);
  Serial.print("Conectando\n");
  WiFi.mode(WIFI_STA);//client, not access point
  while(WiFi.status() != WL_CONNECTED){
    delay(500);
    Serial.print("*");
  }
  Serial.print("Connected to WiFi network with IP Address: ");
  Serial.println(WiFi.localIP());
}

void loop() {
  if(WiFi.status() == WL_CONNECTED){ 
  digitalWrite(led, HIGH);   // Led ON
  delay(1000);              // pausa 1 seg
  SendDataToHost();
  digitalWrite(led, LOW);    // Led OFF
  delay(50000);              // pausa 100seg
  if (motor == 1){
    digitalWrite(relay, HIGH); 
  }
  else{
    digitalWrite(relay, LOW); 
  }
  }
  else{
  Serial.print("desconectado\n");
  digitalWrite(led, LOW);    // Led OFF
  }
delay(1000);
}
