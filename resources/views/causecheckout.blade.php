<!DOCTYPE html>
<html>
<head>
	<title>Select a Cause</title>
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>

	<div class="container">
    <h1>Before You Checkout...</h1>
		<div class="row">
      @foreach ($causes as $cause)
			<div class="col-md-3">
        <img src="{{ Voyager::image( $cause->image ) }}" style="width:100%">
        <h2>{{ $cause->name }}</h2>
        <p>{{ $cause->excerpt }}</p>
        <p><a href="{{ route('causecheckout.show', $cause->slug) }}" target="_blank">Learn More</a></p>
      </div>
      @endforeach
		</div>
	</div>
</body>
</html>