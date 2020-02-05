# P1-encrypted-message
El programa recibe dos instrucciones y un mensaje, y el resultado debe ser si existe o no una instrucción escondida en el mensaje.

Como ejecutarlo en entorno local
si por defecto queremos llamar el programa con el archivo ejemplo "file1.txt" se llamara la url de la siguiente manera:
http://localhost/P1-encrypted-message/P1-encrypted-message.php
si queremos probar con un archivo diferente, sera necesario colocar dicho archivo en la carpeta "test-files/" y pasar el nombre del archivo en el request,
el nombre del archivo puede venir en POST o GET "file_to_decrypt". Ejemplo en la isguiente url mandaremos verificar el archivo "file2.txt":
http://localhost/P1-encrypted-message/P1-encrypted-message.php?file_to_decrypt=file2.txt
