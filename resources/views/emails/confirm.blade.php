<html>
<head></head>
<body>
<h1>Your Order has been Created</h1>
<p>Thank {{$user->name}} </p>
<p>your order has been created with below details :</p>
<ul>
    <li>Number : {{$inserted->number}}</li>
    <li>Title : {{$inserted->title}}</li>
    <li>Location : {{$inserted->location_id}}</li>
    <li>Key : {{$inserted->key}}</li>
    <small>this key is required to close the order , or to show it for othere .</small>
</ul>

</body>
</html>