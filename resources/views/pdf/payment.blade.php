<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Payment Details</title>
</head>
<body>
    <h2>Comprobante de Pago de Alquiler</h2>
    <h3 style="color: #7a818c">{{ $payment->leaseId->propertyId->name}}</h3>
    <br>
    <hr>
    <div style="font-size: 12.5px">
        <table class="demo">
	
        <thead>
            <tr style="color: #c0c2c5;  font-weight:bold;">
                <th>N&uacute;mero de recibo</th>
                <th>Fecha de pago</th>
                <th>Arrendatario</th>
                <th>Direcci&oacute;n</th>
            </tr>
        </thead>
	    <tbody>
        <tr>
            <td>{{ $payment->id }}</td>
            <td>{{ $payment->payment_date }}</td>
            <td>{{ $payment->leaseId->tenantId->name}} {{ $payment->leaseId->tenantId->lastname}}</td>
            <td>{{ $payment->leaseId->propertyId->address}}</td>
        </tr>
        </tbody>
    </table>
    
        
    </div>
    <hr>
    <br>
    <div style="font-size: 14px">
        
            <h3>Detalle de pago</h3>
        
        <table>

            <tr>
                <th style="color: #384251;">Tipo de pago</th>
                <td style="color: #374151;  font-weight:bold">{{ $payment->paymentTypeId->name }}</td>
            </tr>
            <tr>
                <th style="color: #384251;">Monto recibido</th>
                <td style="color: #374151; font-weight:bold">${{ $payment->payment }}</td>
            </tr>
            <tr>
                <th style="color: #384251;">Correspondiente al mes de</th>
                <td style="color: #374151; font-weight:bold">${{ $payment->payment }}</td>
            </tr>
         
            
            
        </table>
    </div>
    <br>
    <div style="text-align: center;">
        <p>
        _____________________________________
        <br>
        {{ $payment->leaseId->propertyId->landlordId->name}} {{ $payment->leaseId->propertyId->landlordId->lastname}}
        <br>
        Responsable
    </div>
        </p>
</body>
</html>
