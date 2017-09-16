@extends('layout.tenantNav')
@section('content')
<section id="home">
		
		<div id="carousel-example" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carousel-example" data-slide-to="0" class="active"></li>
    <li data-target="#carousel-example" data-slide-to="1"></li>
    <li data-target="#carousel-example" data-slide-to="2"></li>
  </ol>

  <div class="carousel-inner">
    <div class="item active">
      <a href="#"><img src="http://placekitten.com/1600/600" /></a>
      <div class="carousel-caption">
        <h3>Meow</h3>
        <p>Just Kitten Around</p>
      </div>
    </div>
    <div class="item">
      <a href="#"><img src="http://placekitten.com/1600/600" /></a>
      <div class="carousel-caption">
        <h3>Meow</h3>
        <p>Just Kitten Around</p>
      </div>
    </div>
    <div class="item">
      <a href="#"><img src="http://placekitten.com/1600/600" /></a>
      <div class="carousel-caption">
        <h3>Meow</h3>
        <p>Just Kitten Around</p>
      </div>
    </div>
  </div>

  <a class="left carousel-control" href="#carousel-example" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left"></span>
  </a>
  <a class="right carousel-control" href="#carousel-example" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right"></span>
  </a>
</div>

<!--MODAL-->
<div class="modal fade" id="buttonModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-sm" role="document">
          <div class="modal-content modal-col-green">
            {{ Form::open([
              'id' => 'myForm', 'class' => 'form-horizontal'
              ])
            }}
            <div class="modal-header">
              <h1 id='label' class="modal-title align-center p-b-15">LOGIN<a href="" class="pull-right" data-dismiss="modal"><i class="mdi-navigation-close"></i></a></h1>
            </div>
            <div class="modal-body">
              <div class="form-group p-l-30 p-b-10">
                <div class="col-sm-12 col-md-12">
                  <div class="form-line">
                    <h5 class="card-inside-title">Username</h5>
                    {{ Form::text('username',null,[
                      'id'=> 'username', 'required' => 'required',
                      'class' => 'form-control'])}}
                  </div>
                </div>
                </div>
                <div class="form-group p-l-30 p-b-10">
                <div class="col-sm-12 col-md-12">
                  <div class="form-line">
                    <h5 class="card-inside-title">Password</h5>
                    {{ Form::text('password',null,[
                      'id'=> 'password', 'required' => 'required',
                      'class' => 'form-control'])}}
                  </div>
                </div>               
              </div>
            </div>
            
         
          <div class="modal-footer">
          
           <button type="submit" class="btn btn-SM bg-brown waves-effect waves-white col-md-12 col-sm-12" id="btnSave" value="add"><i class="mdi-content-save"></i><span id='lblButton'> SAVE</span></button>

           {{ Form::hidden(null,null,[
            'id'=> 'myId'
            ])
          }}
        
        </div>
        {{Form::close()}}
      </div>
    </div>
  </div>

</section><!--/#home-->

@endsection