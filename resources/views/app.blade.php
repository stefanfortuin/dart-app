<x-base>
<div id="app" class="h-full relative"></div>
@if(auth()->check())
<script>
    window.logged_in_user =  @json($logged_in_user);
    window.csrf_token = "{{csrf_token()}}"
</script>
@endif
<script src="{{mix('js/app.js')}}"></script>
</x-base>