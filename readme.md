Explicación de las secciones composer.json:
# PrinterPDF Service.

## Descripción
Este proyecto busca satisfacer una necesidad de contar con un servicio de almacenamiento e impresion de PDF de multiples origenes, con el animo de no tener impresiones PDF en diferentes aplicacion sino centralizar todo en un servicio que imprime el documento y luego la aplicacion externa guarda ya sea el documento PDF o en su defecto el link de acceso. 

## Version
0.01 

## Tipo de Proyecto
Este es un proyecto de PHP.

## Dependencias
Para que el proyecto funcione correctamente, se requieren las siguientes dependencias:

- **mpdf/mpdf**: La librería que se usa para generar los archivos PDF.
- **vlucas/phpdotenv**: Permite manejar variables de entorno para cargar configuraciones, como claves secretas o configuraciones del servidor.
- **firebase/php-jwt**: Para manejar la autenticación mediante tokens JWT (esto es lo que permite que solo los usuarios con el token adecuado puedan acceder al servicio).

## Autoload
Define la ruta para la carga automática de clases con el estándar PSR-4. En este caso, asocia el namespace `App` con la carpeta `src/`.

## Dependencias de Desarrollo
Dependencias solo necesarias para el desarrollo, como PHPUnit para realizar tests. Esto es opcional si planeas escribir tests para tu código.

## Scripts
Puedes definir comandos personalizados, como ejecutar tests con phpunit.

## Configuración Adicional
Configuraciones adicionales de Composer, como la optimización del autoload.

## Estabilidad Mínima
Define la estabilidad mínima de los paquetes que puedes instalar. `stable` asegura que solo se instalen versiones estables.

## Preferencia por Estables
Se da preferencia a versiones estables de las dependencias.

## Instrucciones de Inicialización

1. **Clonar el repositorio**:
    ```bash
    git clone https://github.com/jdvillegas/pdfPrinter.git
    ```

2. **Instalar dependencias**:
    ```bash
    composer install
    ```

3. **Configurar variables de entorno**:
    Crea un archivo `.env` en la raíz del proyecto y define las variables necesarias, como claves secretas o configuraciones del servidor.

4. **Ejecutar el proyecto**:
    Dependiendo de la configuración del servidor, asegúrate de que el servidor web esté apuntando a la carpeta pública del proyecto.

5. **Ejecutar tests (opcional)**:
    Si has definido tests, puedes ejecutarlos con:
    ```bash
    composer test
    ```

## Notas Adicionales
- Asegúrate de tener configurado un servidor web compatible con PHP.
- Revisa la documentación de cada librería para más detalles sobre su uso y configuración.

