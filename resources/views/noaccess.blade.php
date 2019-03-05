<h3>
  Hola en este momento tu usuario no esta disponible en este sistema por favor dar clic en el boton para salir. Gracias XD!!!
</h3>
<button><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
  
 <i class="fas fa-sign-out-alt"></i> Salir</a> </button></li>
 <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    {{ csrf_field() }}
</form>