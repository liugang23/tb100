




@section('my-js')
	@if (count($errors) > 0)
		@foreach ($errors->all() as $error)
			<span class="err" style="">{{ $error }}</span>
		@endforeach
		<script>
		err = $(".err").html();
		$("#ts").html(err);
		swal(err);
		</script>
	@endif
@endsection