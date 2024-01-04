<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Printed lease contract</title>
</head>

<body>
    [Nombre del Arrendador]
[Dirección del Arrendador]
[Teléfono del Arrendador]
[Correo Electrónico del Arrendador]

{{$lease->tenantId->name}} {{$lease->tenantId->lastname}}
<br>
{{$lease->tenantId->phone}}


CONTRATO DE ARRENDAMIENTO RESIDENCIAL

Este Contrato de Arrendamiento ("Contrato") se celebra el [Fecha de Inicio], entre el arrendador mencionado anteriormente ("Arrendador") y el arrendatario mencionado anteriormente ("Arrendatario").

1. PROPIEDAD ARRENDADA: El Arrendador acuerda arrendar y el Arrendatario acuerda tomar en arrendamiento la propiedad ubicada en [Dirección de la Propiedad] ("Propiedad") por un período de seis (6) meses, comenzando el [Fecha de Inicio] y terminando el [Fecha de Término].

2. RENTA MENSUAL: El Arrendatario pagará al Arrendador la suma de doscientos setenta y cinco dólares (275 USD) mensuales como alquiler, el cual deberá ser pagado antes del [Día del Mes] de cada mes.

3. PAGO DEL DEPÓSITO DE SEGURIDAD: El Arrendatario entregará al Arrendador un depósito de seguridad de [Cantidad] dólares (Cantidad USD) antes de la ocupación de la Propiedad. Este depósito será devuelto al Arrendatario dentro de los [Días] días siguientes a la terminación de este Contrato, menos cualquier deducción permitida por la ley.

4. AUTORENOVACIÓN: Este Contrato se renovará automáticamente por períodos sucesivos de seis (6) meses, a menos que cualquiera de las partes notifique a la otra parte por escrito su intención de no renovar con al menos treinta (30) días de antelación a la fecha de vencimiento.

5. OBLIGACIONES DEL ARRENDATARIO: El Arrendatario se compromete a mantener y cuidar adecuadamente la Propiedad, pagar la renta puntualmente y cumplir con todas las leyes y reglamentos locales relacionados con el uso de la Propiedad.

6. OBLIGACIONES DEL ARRENDADOR: El Arrendador se compromete a proporcionar una vivienda en condiciones habitables, realizar reparaciones necesarias y cumplir con todas las obligaciones legales y reglamentarias aplicables.

7. TERMINACIÓN ANTICIPADA: Cualquiera de las partes puede dar por terminado este Contrato antes del vencimiento del plazo especificado en caso de incumplimiento material por parte de la otra parte.

Este Contrato constituye el entendimiento completo entre las partes y no puede ser modificado excepto por escrito y firmado por ambas partes.

Firmado este [Fecha de Firma].

______________________________           ______________________________
[Nombre del Arrendador]                         [Nombre del Arrendatario]

[Firma del Arrendador]                               [Firma del Arrendatario]
    {{$lease->tenantId->name}}
</body>
</html>