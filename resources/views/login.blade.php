@extends('adminlte::master')

@section('title', 'eSemakanRisiko')

@section('adminlte_css')
<style>
    .bg {
      background-image: url("{{asset('canseleri.jpg')}}");
      background-size: cover;
      background-repeat: no-repeat;
      background-position: 50% 50%;
}
    header {
  position: relative;
  background-color: black;
  height: 100vh;
  min-height: 25rem;
  width: 100%;
  overflow: hidden;
}

header video {
  position: absolute;
  top: 50%;
  left: 50%;
  min-width: 100%;
  min-height: 100%;
  width: auto;
  height: auto;
  z-index: 0;
  -ms-transform: translateX(-50%) translateY(-50%);
  -moz-transform: translateX(-50%) translateY(-50%);
  -webkit-transform: translateX(-50%) translateY(-50%);
  transform: translateX(-50%) translateY(-50%);
}

header .container {
  position: relative;
  z-index: 2;
}

header .overlay {
  position: absolute;
  top: 0;
  left: 0;
  height: 100%;
  width: 100%;
  background-color: black;
  opacity: 0.5;
  z-index: 1;
}
    
.button {
  border-radius: 4px;
  background-color: cadetblue;
  border: none;
  color: #FFFFFF;
  text-align: center;
  font-size: 28px;
  padding: 20px;
  width: 200px;
  transition: all 0.5s;
  cursor: pointer;
  margin: 5px;
}

.button span {
  cursor: pointer;
  display: inline-block;
  position: relative;
  transition: 0.5s;
}

.button span:after {
  content: '\00bb';
  position: absolute;
  opacity: 0;
  top: 0;
  right: -20px;
  transition: 0.5s;
}

.button:hover span {
  padding-right: 25px;
}

.button:hover span:after {
  opacity: 1;
  right: 0;
}
    
@media (pointer: coarse) and (hover: none) {
  header {
    background: url('https://source.unsplash.com/XT5OInaElMw/1600x900') black no-repeat center center scroll;
  }
  .logouitm {

  }

  header video {
    display: none;
  }
}
    
    </style>
@stop

@section('classes_body')
login-page  pace-done
@stop

@section('body_data')
style="min-height: 0px;"
@stop

@section('body')
<div class="pace  pace-inactive"><div class="pace-progress" data-progress-text="100%" data-progress="99" style="transform: translate3d(100%, 0px, 0px);">
  <div class="pace-progress-inner"></div>
</div>
<div class="pace-activity"></div></div>
<header class="bg">
  <div class="overlay"></div>
  <div class="container h-100">
    <div class="d-flex h-100 text-center align-items-center">
    
      <div class="w-100 text-white">
      <a href="/" class="logouitm">
        <img src="{{ asset('uitm_logo.png') }}" style="max-height:100px">
      </a>
        <h1 class="display-4 pt-5 mb-4">e<b>SemakanRisiko</b></h1>
        <p class="lead mb-0 text-center">
          <a href="/redirect" class="button btn-default"><i class="fab fa-google"></i><span>&nbsp;&nbsp;&nbsp;Log Masuk Dengan Google </span></a>
        </p>
      </div>
    </div>
  </div>
</header>
@stop