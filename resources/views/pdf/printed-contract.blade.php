<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Printed lease contract</title>
</head>

<body>

<br>
<b>CONTRATO DE ARRENDAMIENTO RESIDENCIAL</b>

<p>
Este Contrato de Arrendamiento ("Contrato") se celebra el [Fecha de Inicio], 
entre <b>{{Str::upper($lease->propertyId->landlordId->name)}} {{Str::upper($lease->propertyId->landlordId->lastname)}}</b>
portador del Documento Único de Identidad número:<b>{{$landlordDocument}}</b>; 
quien en el transcurso de este Documento se denominará "El Arrendante" , 
Y <b>{{Str::upper($lease->tenantId->name)}} {{Str::upper($lease->tenantId->lastname)}}</b> con Documento Único de 
Identidad número:<b>{{$tenantDocument}}</b>; que en lo sucesivo se denominará "Arrendatario". Por medio del siguiente documento
se otorga:
</p>
<br>
<b>PRIMERO:</b> El Arrendante acuerda arrendar y el Arrendatario acuerda tomar en arrendamiento la 
propiedad ubicada en <b>{{$lease->propertyId->address}}</b> ("Propiedad"). La Propiedad Arrendada cuenta con las siguientes amenidades:
El cual se regirá por las estipulaciones que se detallan en las caúsales siguientes: 
<br>
<b>SEGUNDO:</b> Que el Arrendante da y entrega en
arrendamiento  una casa en perfectas condiciones, y que el arrendatario la recibe a su entera satisfacción bajo las condiciones
siuientes: 
<br>
<b>TERCERO: PLAZO:</b> El plazo del Arrendamiento será por <b>{{Str::upper($lease->rentType->name)}}</b> prorrogables, contados 
a partir del {{$lease->human_readable_contract_date}}, y terminando el día {{$lease->human_readable_expiration_date}}, plazo 
que será prorrogable según lo convengan las partes.
.  
<br>
<b>CUARTO: PRECIO:</b> El Valor del Arrendamiento será de    al Arrendador la suma de doscientos setenta y cinco dólares (275 USD) mensuales como alquiler, el cual deberá ser pagado antes del [Día del Mes] de cada mes.

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