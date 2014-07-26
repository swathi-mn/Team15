<html>
<head>
<script>
geocoder = new google.maps.Geocoder();
geocoder.geocode({ 'address': '110021'}, function(results, status) {
    console.log(results);
});
</script>
<body>
</body>
</html>