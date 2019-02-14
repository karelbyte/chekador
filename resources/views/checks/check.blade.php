@extends('layouts.app')

@section('content')
    <div class="page-header row no-gutters py-4">
        <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
            <h3 class="page-title">Historico de @{{ person.names }}</h3>
            <input type="text" id="person" value="{{$id}}" hidden>
        </div>
    </div>

        <div v-if="views.list" class="row">
            <div class="col-lg-12">
                <div class="card card-small mb-4">
                    <div class="card-header border-bottom">
                        <div class="row">
                            <div class="col-lg-1 col-sm-1 text-center text-sm-left mb-0">
                                <button class="btn btn-link btn-sm" @click="back()"><i class="fa fa-chevron-circle-left "></i> Regresar</button>
                            </div>
                            <div class="col-lg-11 col-sm-1 text-center text-sm-left mb-0">
                                <paginator :tpage="totalpage" :pager="pager" v-on:getresult="getlist"></paginator>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0 pb-3">
                        <table class="table mb-0 table-hover">
                            <thead class="bg-light">
                            <tr>
                                <th scope="col" class="border-0"></th>
                                <th scope="col" class="border-0">
                                    <div class="input-group">
                                        <input type="date" class="form-control" v-model="moment" ><div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon2"><i class="fa fa-filter"></i></span>
                                        </div>
                                    </div>

                                </th>
                                <th scope="col" class="border-0">

                                    <div class="input-group">
                                        <select class="form-control custom-select"  v-model="motive">
                                            <option v-for="mot in  motives" :value="mot.id">@{{ mot.motive }}</option>
                                        </select>
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon2"><i class="fa fa-filter"></i></span>
                                        </div>
                                    </div>
                                </th>
                                <th scope="col" class="border-0"></th>
                                <th scope="col" class="border-0"></th>
                            </tr>
                            <tr>
                                <th scope="col" class="border-0">Camara</th>
                                <th scope="col" class="border-0">Fecha</th>
                                <th scope="col" class="border-0">Division</th>
                                <th scope="col" class="border-0">Motivo</th>
                                <th scope="col" class="border-0">Nota</th>
                                <th scope="col" class="border-0"></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="entity in lists" class="mouse">
                                <td><img :src="'/'+ entity.url_screen" alt="" width="100" @click="imgFull(entity.url_screen)"></td>
                                <td>@{{ entity.moment }}</td>
                                <td>@{{ entity.division }}</td>
                                <td>@{{ entity.motive }}</td>
                                <td>@{{ entity.note }}</td>
                                <td>
                                    <button class="btn btn-danger btn-sm" @click="showdelete(entity)"><i class="fa fa-eraser"></i></button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-lg-1 col-sm-1 text-center text-sm-left mb-0">
                                <button class="btn btn-link btn-sm" @click="back()"><i class="fa fa-chevron-circle-left "></i> Regresar</button>
                            </div>
                            <div class="col-lg-11 col-sm-1 text-center text-sm-left mb-0">
                                <paginator :tpage="totalpage" :pager="pager" v-on:getresult="getlist"></paginator>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <div id="img" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-secondary">
                    <h5 class="modal-title" style="color: black" id="exampleModalLabel">Visor</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img :src="'/'+ img" alt="" width="98%">
                </div>
                <div class="modal-footer">
                    <a href="#" data-dismiss="modal" class="btn btn-default  btn-sm">Cerrar</a>
                </div>
            </div>
        </div>
    </div>

@component('components.eliminar')@endcomponent
@component('components.spiner')@endcomponent
@endsection
@section('script')
    @parent
    <script src="{{asset('appjs/components/paginator.js')}}"></script>
    <script src="{{asset('appjs/components/personsdetails.js')}}"></script>
    <script src="{{asset('appjs/components/order.js')}}"></script>
    <script src="{{asset('appjs/checks.js')}}"></script>
@endsection
