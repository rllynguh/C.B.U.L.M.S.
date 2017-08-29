@extends('layout.tenantNav')
@section('content')
<section id="home">
		
		<div id="main-carousel" class="carousel slide" data-ride="carousel"> 
			<ol class="carousel-indicators">
				<li data-target="#main-carousel" data-slide-to="0" class="active"></li>
				<li data-target="#main-carousel" data-slide-to="1"></li>
				<li data-target="#main-carousel" data-slide-to="2"></li>
			</ol><!--/.carousel-indicators--> 
			<div class="carousel-inner">
				<div class="item active" style="background-image: url(../images/tenant/slide1.jpg)"> 
					<div class="carousel-caption"> 
						<div> 
							<h2 class="heading animated bounceInDown">Welcome to Majent</h2> 
							<p class="animated bounceInUp">Change the world with us</p> 

							<button type="button" class="btn btn-default slider-btn animated fadeIn" data-toggle="modal" data-target="#buttonModal">Get Started</button> 
						</div> 
					</div> 
				</div>
				
				<div class="item" style="background-image: url(../images/tenant/slide2.jpeg)"> 
					<div class="carousel-caption"> <div> 
						<h2 class="heading animated bounceInDown">budget?</h2> 
						<p class="animated bounceInUp">Let us give you great and flexible deal.</p> <button type="button" class="btn btn-default slider-btn animated fadeIn" data-toggle="modal" data-target="#buttonModal">Get Started</button>  
					</div> 
				</div> 
			</div>  
			<div class="item" style="background-image: url(../images/tenant/slide3.jpeg)"> 
				<div class="carousel-caption"> 
					<div> 
						<h2 class="heading animated bounceInRight">We care</h2> 
						<p class="animated bounceInLeft">Let us grow together</p> 
						<button type="button" class="btn btn-default slider-btn animated fadeIn" data-toggle="modal" data-target="#buttonModal">Get Started</button> 					</div> 
				</div> 
			</div>
		</div><!--/.carousel-inner-->

		<a class="carousel-left member-carousel-control hidden-xs" href="#main-carousel" data-slide="prev"><i class="fa fa-angle-left"></i></a>
		<a class="carousel-right member-carousel-control hidden-xs" href="#main-carousel" data-slide="next"><i class="fa fa-angle-right"></i></a>
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