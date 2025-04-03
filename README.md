---
# **Sistema de Estado de Puerta con ESP32 y PHP**  

## **1. Descripción General**  
Este sistema permite actualizar en tiempo real el estado de una puerta en una página web. Usa un ESP32 y un sensor infrarrojo (IR) para detectar si la puerta está abierta o cerrada, lo que indica la disponibilidad de una persona.  

Este sistema se puede montar en un servidor local usando **XAMPP**, lo que facilita su configuración y pruebas sin necesidad de un servidor en la nube.  

## **2. Componentes del Sistema**  

### **2.1 Hardware**  
- **ESP32**: Microcontrolador que lee el estado del sensor IR y envía los datos al servidor.  
- **Sensor IR**: Detecta si la puerta está abierta o cerrada.  
- **Conexión WiFi**: Permite al ESP32 enviar datos al servidor PHP.  

### **2.2 Software**  
- **PHP y MySQL**: Backend que recibe y almacena los datos del estado de la puerta.  
- **HTML, CSS, y JavaScript**: Interfaz web para visualizar el estado en tiempo real.  
- **ESP32 Firmware (Arduino IDE o PlatformIO)**: Código que lee el sensor y envía datos al servidor.  
- **XAMPP**: Software que permite montar un servidor local con Apache, MySQL y PHP para ejecutar el sistema sin necesidad de hosting externo.  

## **3. Funcionamiento**  
1. **El ESP32** detecta el estado de la puerta a través del sensor IR.  
2. **Envía una solicitud HTTP (POST o GET) a un script PHP** alojado en un servidor.  
3. **El script PHP actualiza la base de datos MySQL** con el estado de la puerta y la hora de la actualización.  
4. **La página web obtiene el estado desde la base de datos** y muestra si la persona está disponible o no.  
5. **JavaScript (AJAX o WebSockets) actualiza la información en tiempo real** sin necesidad de recargar la página.  

## **4. Base de Datos**  
El sistema usa la base de datos `estados` con la tabla `estados`:  

| Campo       | Tipo         | Descripción |
|-------------|-------------|-------------|
| `id`        | `INT(11)`   | Identificador único, autoincremental. |
| `Usuarios`  | `TEXT`      | Nombre o identificador del usuario. |
| `estado`    | `TINYINT(4)` | 0 = No disponible (puerta cerrada), 1 = Disponible (puerta abierta). |
| `fecha_hora` | `DATETIME`  | Hora de la última actualización. |

## **5. API PHP (Ejemplo de Endpoint)**  
El ESP32 envía datos al servidor mediante una petición HTTP a un script PHP (`actualizar_estado.php`), que actualiza la base de datos.  

### **Ejemplo de Código PHP**  
> **Nota:** Reemplazar los datos de acceso a la base de datos (`servername`, `username`, `password`, `dbname`) con la configuración correspondiente.

Descargar el archivo estados.php

## **6. Código en ESP32 (Ejemplo en Arduino)**  
> **Nota:** Reemplazar `SSID`, `TuContraseña`, `tu-servidor` y `ID_Dispositivo` con los valores correspondientes.

Descargar el archivo SICE.ino

## **7. Visualización en la Página Web**  
La página web usa AJAX para actualizar la información sin necesidad de recargar.  

### **Ejemplo de Código en php + JavaScript**  
Descargar el archivo de nombre estado.php

## **8. Conclusión**  
Este sistema ofrece una solución eficiente y en tiempo real para monitorear la disponibilidad de una persona a través del estado de la puerta. Además, se puede implementar en un servidor local utilizando **XAMPP**, lo que facilita su uso y pruebas sin depender de un servidor en la nube.  
