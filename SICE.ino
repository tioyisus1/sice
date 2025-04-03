#include <WiFi.h>
#include <HTTPClient.h>

// Lista de redes WiFi disponibles
const char* wifiNetworks[][2] = {
  {"SSID1", "PWD1"},
  {"SSID2", "PWD2"},
  {"SSID3", "PWD3"},
  {"SSID4", "PWD4"},
  {"SSID5", "PWD5"},
  {"SSID6", "PWD6"}
}; //Reemplaza nos SSID Y PWD por los datos de red.

const char* serverName = "http://xxxxxxxx/update.php";  // URL de tu servidor
int irSensorPin = 13; // El pin donde está conectado el sensor IR
int estado = 0; // Inicializamos el estado en 0 (no detectado)

void conectarWiFi() {
  for (int i = 0; i < sizeof(wifiNetworks) / sizeof(wifiNetworks[0]); i++) {
    Serial.print("Intentando conectar a ");
    Serial.println(wifiNetworks[i][0]);

    WiFi.begin(wifiNetworks[i][0], wifiNetworks[i][1]);
    unsigned long startTime = millis();

    // Esperar un máximo de 10 segundos para conectarse
    while (WiFi.status() != WL_CONNECTED && millis() - startTime < 10000) {
      delay(500);
      Serial.print(".");
    }

    if (WiFi.status() == WL_CONNECTED) {
      Serial.print("\nConectado a ");
      Serial.println(wifiNetworks[i][0]);
      return;
    } else {
      Serial.println("\nNo se pudo conectar a esta red.");
    }
  }
  
  Serial.println("No se pudo conectar a ninguna red.");
}

void setup() {
  Serial.begin(115200);
  pinMode(irSensorPin, INPUT);

  conectarWiFi();
}

void loop() {
  estado = digitalRead(irSensorPin);  // Leer el estado del sensor IR (1 si hay objeto, 0 si no hay)
  Serial.print("Estado del sensor IR: ");
  Serial.println(estado);

  if (WiFi.status() == WL_CONNECTED) {
    HTTPClient http;
    String url = String(serverName) + "?estado=" + estado + "&id=1"; // Se manda el estado y el ID del sensor - CAMBIAR EL "1" POR EL NUMERO DEL SENSOR QUE VA A CONFIGURAR

    http.begin(url); // Iniciar la solicitud HTTP
    int httpCode = http.GET(); // Enviar la solicitud GET

    if (httpCode > 0) {
      Serial.println("Datos enviados correctamente");
    } else {
      Serial.println("Error al enviar los datos");
    }

    http.end();  // Finalizar la conexión
  } else {
    Serial.println("No hay conexión WiFi, intentando reconectar...");
    conectarWiFi();
  }

  delay(2000); // Esperar 2 segundos antes de enviar los datos nuevamente
}
