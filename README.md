
<p align="center"><a href=https://www.php.net/"" target="_blank"><img src="https://cdn.freebiesupply.com/logos/large/2x/php-1-logo-png-transparent.png" width="400" alt="Laravel Logo"></a></p>


# Prueba desarrollo
Este repositorio forma parde de una prueba de desarrollo en la cual se propuso como entregable una pagina web.


### Tecnologias usadas

- [PHP](https://www.php.net/).
- [WampServer](https://wampserver.aviatechno.net/).
- [SQL](https://wampserver.aviatechno.net/).
- [reCAPTCHA](https://developers.google.com/recaptcha/docs/v3?hl=es-419).
- [SweetAlert2](https://developers.google.com/recaptcha/docs/v3?hl=es-419).

### Requerimientos

- Registro de Usuarios: Se implementó una sección de registro donde los usuarios pueden proporcionar sus datos personales y responder a cuatro preguntas predefinidas. Para prevenir el registro automatizado, se integró un mecanismo de verificación reCAPTCHA.
- Autenticación: Se desarrolló un sistema de autenticación que permite a los usuarios iniciar sesión con sus credenciales.
- Visualización de Registros: Se implementó una vista de registros con permisos diferenciados:
  - Usuarios Administradores: Pueden acceder a la información completa de todos los usuarios registrados.
  - Usuarios Estándar: Solo pueden visualizar sus propios datos registrados.
- Gestión de Preguntas: Se proporcionó a los usuarios administradores la capacidad de modificar las preguntas del formulario de registro. Sin embargo, se mantiene un registro histórico de las preguntas y respuestas anteriores a cualquier cambio realizado por un administrador.

### Implementación
Se adoptó la arquitectura MVC (Modelo-Vista-Controlador) para estructurar el proyecto, promoviendo una clara separación de responsabilidades entre los componentes de la aplicación:

- Modelo: Encapsula la lógica de negocio, la gestión de datos y las interacciones con la base de datos, garantizando la integridad y consistencia de la información.
- Vista: Se encarga de presentar la información al usuario de manera amigable y de capturar las interacciones del usuario con la aplicación.
- Controlador: Actúa como intermediario entre el modelo y la vista, procesando las solicitudes del usuario, actualizando el modelo y generando la respuesta adecuada en la vista.
  
Además, se implementó un enfoque de programación orientada a objetos, donde se definieron clases para representar las diferentes entidades y funcionalidades del sistema.
