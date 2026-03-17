<p align="center">
  <a href="https://github.com/OctoverianSpark/HelpDESK" rel="noopener">
    <img width=200px height=200px src="https://i.imgur.com/6wj0hh6.jpg" alt="Project logo">
  </a>
</p>

<h3 align="center">HelpDESK</h3>

<div align="center">

  [![Status](https://img.shields.io/badge/status-active-success.svg)]()
  [![GitHub Issues](https://img.shields.io/github/issues/OctoverianSpark/HelpDESK.svg)](https://github.com/OctoverianSpark/HelpDESK/issues)
  [![GitHub Pull Requests](https://img.shields.io/github/issues-pr/OctoverianSpark/HelpDESK.svg)](https://github.com/OctoverianSpark/HelpDESK/pulls)
  [![License](https://img.shields.io/badge/license-Apache--2.0-blue.svg)](/LICENSE)

</div>

---

<p align="center">
  Sistema web de gestión de tickets de soporte técnico interno, con módulo de inventario, encuestas de satisfacción, integración con Active Directory y exportación de reportes.
  <br>
</p>

## 📝 Tabla de contenido

- [Acerca de](#-acerca-de)
- [Comenzando](#-comenzando)
- [Implementación](#-implementación)
- [Uso](#-uso)
- [Construido con](#-construido-con)
- [Autores](#-autores)

---

## 🧐 Acerca de

HelpDESK es una aplicación web desarrollada para el área de TI, que centraliza la gestión de solicitudes de soporte técnico a través de un sistema de tickets. Permite a los empleados reportar incidencias o hacer solicitudes, y al equipo de TI registrar, gestionar y resolver cada caso con seguimiento completo.

El sistema cuenta además con un módulo de inventario de equipos, encuestas de satisfacción al cierre de tickets, integración con Active Directory para autenticación de usuarios, generación de reportes en Excel y PDF, y una API interna para integraciones externas.

---

## 🏁 Comenzando

Estas instrucciones permiten obtener una copia del proyecto en funcionamiento en un entorno local para desarrollo y pruebas.

### Requisitos previos

- PHP 8.1 o superior
- MySQL 8.0 o superior
- Composer (gestor de dependencias de PHP)
- Node.js 18+ y npm (para compilar los assets del frontend)
- Servidor web Apache con soporte para `.htaccess` (mod_rewrite activado)

```bash
# Verificar versiones instaladas
php -v
mysql --version
composer --version
node -v
```

### Instalación en Linux (Ubuntu / Debian)

**1. Instalar dependencias del sistema**

```bash
sudo apt update
sudo apt install -y apache2 mysql-server php8.1 php8.1-mysql php8.1-zip \
  php8.1-gd php8.1-mbstring php8.1-xml php8.1-curl php8.1-ldap \
  composer nodejs npm git
```

Habilitar `mod_rewrite` de Apache:

```bash
sudo a2enmod rewrite
sudo systemctl restart apache2
```

**2. Clonar el repositorio**

```bash
cd /var/www/html
sudo git clone https://github.com/OctoverianSpark/HelpDESK.git helpdesk
cd helpdesk
```

**3. Instalar dependencias de PHP y frontend**

```bash
composer install
npm install
npm run build
```

**4. Configurar la base de datos**

```bash
sudo mysql -u root -p < TI.sql
```

**5. Configurar la conexión a la base de datos**

Editar el archivo de configuración en `includes/` con los datos de tu servidor MySQL:

```php
define('DB_HOST', 'localhost');
define('DB_NAME', 'ti');
define('DB_USER', 'tu_usuario');
define('DB_PASS', 'tu_contraseña');
```

**6. Configurar permisos**

```bash
sudo chown -R www-data:www-data /var/www/html/helpdesk
sudo chmod -R 755 /var/www/html/helpdesk/public
```

**7. Configurar Apache**

Crear un archivo de configuración para el sitio:

```bash
sudo nano /etc/apache2/sites-available/helpdesk.conf
```

Contenido del archivo:

```apache
<VirtualHost *:80>
    DocumentRoot /var/www/html/helpdesk
    <Directory /var/www/html/helpdesk>
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```

Activar el sitio y reiniciar Apache:

```bash
sudo a2ensite helpdesk.conf
sudo systemctl restart apache2
```

**8. Acceder a la aplicación**

```
http://localhost/
```

---

### Instalación en Windows

**1. Instalar XAMPP**

Descargar e instalar [XAMPP](https://www.apachefriends.org/es/index.html) (incluye Apache, MySQL y PHP).
Durante la instalación, seleccionar los módulos: **Apache**, **MySQL** y **PHP**.

**2. Instalar herramientas adicionales**

- [Composer](https://getcomposer.org/Composer-Setup.exe) — descargar e instalar el ejecutable
- [Node.js](https://nodejs.org/) — descargar e instalar la versión LTS
- [Git](https://git-scm.com/download/win) — descargar e instalar

**3. Clonar el repositorio**

Abrir **Git Bash** o el **Símbolo del sistema** y ejecutar:

```bash
cd C:\xampp\htdocs
git clone https://github.com/OctoverianSpark/HelpDESK.git helpdesk
cd helpdesk
```

**4. Instalar dependencias de PHP y frontend**

```bash
composer install
npm install
npm run build
```

**5. Configurar la base de datos**

Abrir el **Panel de control de XAMPP**, iniciar **Apache** y **MySQL**, luego abrir una terminal y ejecutar:

```bash
mysql -u root -p < TI.sql
```

O importar el archivo `TI.sql` desde **phpMyAdmin** (`http://localhost/phpmyadmin`).

**6. Configurar la conexión a la base de datos**

Editar el archivo de configuración en `includes/` con los datos de tu servidor MySQL:

```php
define('DB_HOST', 'localhost');
define('DB_NAME', 'ti');
define('DB_USER', 'root');
define('DB_PASS', '');
```

**7. Habilitar extensiones PHP**

Abrir el archivo `C:\xampp\php\php.ini` y asegurarse de que las siguientes líneas estén sin el `;` al inicio:

```ini
extension=zip
extension=gd
extension=mbstring
extension=pdo_mysql
extension=ldap
extension=curl
```

Reiniciar Apache desde el Panel de control de XAMPP.

**8. Acceder a la aplicación**

```
http://localhost/helpdesk/
```

El sistema redirigirá automáticamente al login. Las credenciales iniciales se encuentran en la base de datos importada.

---

## 🚀 Implementación

Para desplegar en un servidor de producción:

1. Copiar el proyecto al directorio del servidor web (ej. `/var/www/html/helpdesk`).
2. Repetir los pasos de instalación de dependencias (`composer install`, `npm run build`).
3. Importar el archivo `TI.sql` en el servidor MySQL de producción.
4. Actualizar el archivo de configuración de base de datos con las credenciales del entorno de producción.
5. Verificar que Apache tenga permisos de escritura en las carpetas `public/` (para archivos subidos) y que `mod_rewrite` esté habilitado.
6. Para integración con Active Directory corporativo, configurar los parámetros LDAP en el archivo de configuración de `includes/`.

---

## 🎈 Uso

El sistema tiene tres niveles de acceso:

**Empleado / Agente**
- Crear tickets de soporte indicando el tipo de problema, descripción y archivos adjuntos.
- Consultar el estado de sus tickets abiertos y cerrados.
- Ver el historial de comentarios del equipo de TI en cada ticket.
- Responder encuestas de satisfacción al cierre de un caso.

**Técnico de TI**
- Ver todos los tickets entrantes desde el panel principal.
- Actualizar el estado de cada ticket (Pendiente, En proceso, Cerrado).
- Agregar comentarios y resoluciones a los tickets.
- Consultar y registrar el inventario de equipos.

**Administrador**
- Acceso completo al panel de administración (`/admin`).
- Gestión de inventario: crear, actualizar y eliminar registros de equipos.
- Revisión de todos los tickets del sistema y sus encuestas.
- Consulta de entradas y reportes generales.
- Generación de reportes exportables en formato Excel y PDF.

---

## ⛏️ Construido con

- [PHP 8](https://www.php.net/) — Lenguaje principal del backend
- [MySQL 8](https://www.mysql.com/) — Base de datos relacional
- [Composer](https://getcomposer.org/) — Gestión de dependencias PHP
- [PHPMailer](https://github.com/PHPMailer/PHPMailer) — Envío de correos electrónicos de notificación
- [Dompdf](https://github.com/dompdf/dompdf) — Generación de reportes en PDF
- [PhpSpreadsheet](https://github.com/PHPOffice/PhpSpreadsheet) — Generación de reportes en Excel
- [PhpWord](https://github.com/PHPOffice/PHPWord) — Generación de documentos Word
- [Intervention Image](https://image.intervention.io/) — Procesamiento de imágenes adjuntas
- [Google API Client](https://github.com/googleapis/google-api-php-client) — Integración con servicios de Google Workspace
- [ADLdap](https://github.com/adldap/adLDAP) — Integración con Active Directory
- [ClickUp PHP](https://github.com/howyi/clickup-php) — Integración con ClickUp
- [TCPDF](https://tcpdf.org/) — Generación adicional de PDFs
- [Gulp](https://gulpjs.com/) — Automatización y compilación de assets del frontend
- [SCSS](https://sass-lang.com/) — Estilos del frontend (compilados con Gulp)

---

## ✍️ Autores

- [@OctoverianSpark](https://github.com/OctoverianSpark) — Desarrollo principal

---

> 📅 *Última actualización: marzo 2026 — HelpDESK v2.5*
