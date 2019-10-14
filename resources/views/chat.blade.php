@extends('layouts.masterChat')
@section('title') CAT Members Chat  @endsection
@section('styles')
    <style media="screen">
    .online{
        color: #32CD32;
    }
    .ffside {
        height: 100%;
        position: fixed;
        z-index: 1;
        top: 0;
        right: 0;
        width: 18em;
        overflow-x: hidden;
        margin-top: 62px;
    }
    .chat_box{
        width:260px;
        padding: 5px;
        position: fixed;
        bottom: 0px;
    }
    .footer-main {
        bottom: 0;
        position: absolute;
    }
    .box {
        margin-bottom: 5px;
    }
    .box.box-primary {
        border-top-color: #1d1d1d;
    }
        .box-title{
            font-weight: 400;
        }
    .box-header.with-border {
        border-bottom: 1px solid #c7c7c7;
    }
    </style>
@stop
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="chatApp">
                <div class="panel panel-default ffside">
                    <div class="panel-heading">CAT Members</div>
                    <div class="panel-body" style="padding:0px;">
                        <ul class="list-group">
                            <li class="list-group-item" v-for="chatList in chatLists" style="cursor: pointer;" @click="chat(chatList)">@{{ chatList.name }}  <i class="fa fa-circle pull-right" v-bind:class="{'online': (chatList.online=='Y')}"></i>  <span class="badge" v-if="chatList.msgCount !=0">@{{ chatList.msgCount }}</span></li>
                            <li class="list-group-item" v-if="socketConnected.status == false">@{{ socketConnected.msg }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-script')
    <script src="{{ asset('js/chat.js') }}" charset="utf-8"></script>
@stop
