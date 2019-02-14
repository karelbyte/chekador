<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" id="main-stylesheet" data-version="1.1.0" href="{{asset('styles/shards-dashboards.1.1.0.min.css')}}">
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('styles/extras.1.1.0.min.css')}}">
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <link rel="stylesheet" href="{{asset('css/main.css')}}">

</head>
<body>
<div id="app" v-cloak>
    <div class="container containerA">
           <div class="flex-row justify-content-center">
               <div class="card">
                   <div class="card-header"> <p class="fecha">@{{ diaSemana }} @{{ dia }} de @{{ mes }} del @{{ anio }} </p></div>
                   <div class="card-body">
                       <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                           <p class="tiempo">@{{  tiempo }} </p>
                           <video autoplay="true" id="camara" ></video>
                       </div>
                       <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt-1">
                           <button class="btn btn-info btn-lg mb-1" @click="setNCodigo(0)"></i>0</button>
                           <button class="btn btn-info btn-lg mb-1" @click="setNCodigo(1)">1</button>
                           <button class="btn btn-info btn-lg mb-1" @click="setNCodigo(2)">2</button>
                           <button class="btn btn-info btn-lg mb-1" @click="setNCodigo(3)">3</button>
                           <button class="btn btn-info btn-lg mb-1" @click="setNCodigo(4)">4</button>
                           <button class="btn btn-info btn-lg mb-1" @click="setNCodigo(5)">5</button><br>
                           <button class="btn btn-info btn-lg mb-1" @click="setNCodigo(6)">6</button>
                           <button class="btn btn-info btn-lg mb-1" @click="setNCodigo(7)">7</button>
                           <button class="btn btn-info btn-lg mb-1" @click="setNCodigo(8)">8</button>
                           <button class="btn btn-info btn-lg mb-1" @click="setNCodigo(9)">9</button>
                           <button class="btn btn-info btn-lg mb-1" @click="deteteNCodigo()"><i class="fa fa-eraser"></i></button>
                           <button class="btn btn-info btn-lg mb-1" @click="deteteNBAN()"><i class="fa fa-ban"></i></button>
                           <input type="text" style="border: 2px solid red" class="form-control text-center fecha" placeholder="CODIGO" v-model="user.token" @keydown="vals($event)">
                       </div>
                       <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt-2 mb-2">
                           <button :disabled="user.token.length <= 0 || calling" class="btn btn-primary btn-lg" @click="checkd()">CHEQUEAR</button>
                           <button :disabled="user.token.length <= 0" class="btn btn-warning btn-lg" @click="showOb()">OTR</button>
                           <canvas id="canvas" style="display: none;"></canvas>
                       </div>
                   </div>
               </div>

           </div>
     </div>
    <div id="modalob" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h5 class="modal-title" style="color: black" id="exampleModalLabel">Sucursal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Motivos
                    <select class="form-control custom-select"  v-model="user.motive_id">
                        <option v-for="mot in  motives" :value="mot.id">@{{ mot.motive }}</option>
                    </select>
                    Nota
                    <textarea class="form-control" v-model="user.note" rows="5"></textarea>
                    <div class="custom-controls-stacked mt-5">
                        <div v-for="div in divisions" class="custom-control custom-radio mb-3">
                            <input type="radio" :id="'c' + div.id" name="customRadio" :value="div.id" class="custom-control-input" v-model="user.division_id">
                            <label class="custom-control-label" :for="'c' + div.id">@{{ div.names }}</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button :disabled="user.division_id === 0" @click="check()" class="btn btn-danger btn-sm">CHEQUEAR</button>
                    <a href="#" data-dismiss="modal" class="btn btn-default  btn-sm">Cerrar</a>
                </div>
            </div>
        </div>
    </div>

    <div id="div" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h5 class="modal-title" style="color: black" id="exampleModalLabel">Sucursal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="custom-controls-stacked">
                        <div v-for="div in divisions" class="custom-control custom-radio mb-3">
                            <input type="radio" :id="'c1' + div.id" name="customRadio" :value="div.id" class="custom-control-input" v-model="user.division_id">
                            <label class="custom-control-label" :for="'c1' + div.id">@{{ div.names }}</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button :disabled="user.division_id === 0" @click="check()" class="btn btn-danger btn-sm">CHEQUEAR</button>
                    <a href="#" data-dismiss="modal" class="btn btn-default  btn-sm">Cerrar</a>
                </div>
            </div>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
<script src="{{asset('appjs/tools.js')}}"> </script>
<script src="{{asset('appjs/toasted.min.js')}}"> </script>
<script src="{{asset('appjs/vue-toasted.js')}}"> </script>
<script src="{{asset('appjs/camera.js')}}"> </script>
</body>
</html>
