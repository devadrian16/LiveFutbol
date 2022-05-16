@extends('layouts.api')

@section('title', 'Pruebas')

@section('css')
<link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
@endsection

@section('content')
<!-- Modal -->
<div class="modal fade" id="estadisticas" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        
      </div>
      <div class="modal-body">
        <div id="wg-api-football-fixture"
            data-host="v3.football.api-sports.io"
            data-refresh="60"
            data-id="718243"
            data-key="{{ env('ApiFootball_API_KEY') }}"
            data-theme=""
            data-show-errors="true"
            class="api_football_loader">
        </div>
      </div>
      <div class="modal-footer">
        
      </div>
    </div>
  </div>
</div>

<!-- Button trigger modal -->
<div id="btn-estadisticas" style="cursor: pointer;">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
        <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
    </svg>
</div>
@endsection

@section('js')
<script type="module" src="https://widgets.api-sports.io/football/1.1.8/widget.js"></script>
<script>
    $('#btn-estadisticas').on('click', function(e) {
        $('#estadisticas').modal('show');
    })
</script>
@endsection