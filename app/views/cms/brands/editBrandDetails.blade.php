@extends('cms.layouts.default')

@section('content')
   @foreach ($brand_info as $b)  
    <div class="row">
        <div class="col-lg-12">  <h1 class="page-header"> <img src="images/brands_logo/{{ $b->brand_logo }}"> Edit the brand "{{ $b->brand_title }}" </h1>    </div>
    </div>

    @include('cms.layouts.partials.errors')
    @include('flash::message')

<div class="panel panel-primary">
    <div class="panel-heading">
        EDIT THE CONTENT OF THE BRAND "{{ $b->brand_title }}"
    </div>
    @endforeach
    
    <div class="panel-body">
        <div class="col-lg-10">
        
        @foreach ($brand_info as $b)  

            {{ Form::open(['route' => ['edit_brand_details_path',  $b->brand_id], 'role' => 'form', 'files' => true]) }}


                 {{ Form::label('brand_title', 'BRAND TITLE:')  }}
               <div class="form-group">
                 
                 <div class='input-group'  style="width:100%;">
                     {{ Form::text('brand_title', $b->brand_title, ['class' => 'form-control', 'placeholder' => 'Brand title'])  }}
    
                 </div>
               </div>

               <div class="form-group" >
                    {{ Form::label('brand_logo', 'ABOUT US IMAGE: (Image size 156 x 64 px)')  }}<br/>
                     <img src="images/brands_logo/{{ $b->brand_logo }}" style="width:10%;">  
                    {{ Form::file('brand_logo', null, ['class' => 'form-control'])  }}
               </div>
           

              {{ Form::label('title_1', 'TITLE 1:')  }}
               <div class="form-group">
                <div class='input-group'  style="width:100%;">
                    @if(!empty($b->title1))
                     {{ Form::text('title_1', $b->title1, ['class' => 'form-control', 'placeholder' => 'Title 1'])  }}
                    @endif

                    @if(empty($b->title1))
                     {{ Form::text('title_1', null, ['class' => 'form-control', 'placeholder' => 'Title 1'])  }}
                    @endif

                 </div>
               </div>

               <div class="form-group">
                    {{ Form::label('brand_txt_1', 'TEXT 1 CONTENT:') }}
                    @if(!empty($b->desc1)) 
                    <textarea name="brand_txt_1" required>{{ $b->desc1 }}</textarea>
                    @endif

                    @if(empty($b->desc1)) 
                    <textarea name="brand_txt_1" required></textarea>
                    @endif

                    <script>
                        CKEDITOR.replace( 'brand_txt_1' );
                    </script>
                </div>




                {{ Form::label('title_2', 'TITLE 2:')  }}
               <div class="form-group">
                 <div class='input-group'  style="width:100%;">
                    @if(!empty($b->title2)) 
                     {{ Form::text('title_2', $b->title2, ['class' => 'form-control', 'placeholder' => 'Title 2'])  }}
                    @endif

                    @if(empty($b->title2)) 
                     {{ Form::text('title_2', null, ['class' => 'form-control', 'placeholder' => 'Title 2'])  }}
                    @endif

                 </div>
               </div>

                <div class="form-group">
                    {{ Form::label('brand_txt_2', 'TEXT 2 CONTENT:') }}
                     @if(!empty($b->desc2)) 
                    <textarea name="brand_txt_2" required>{{ $b->desc2 }}</textarea>
                    @endif

                    @if(empty($b->desc2)) 
                    <textarea name="brand_txt_2" required></textarea>
                    @endif

                    <script>
                        CKEDITOR.replace( 'brand_txt_2' );
                    </script>
                </div>



                {{ Form::label('title_3', 'TITLE 3:')  }}
               <div class="form-group">
                 <div class='input-group'  style="width:100%;">
                     @if(!empty($b->title3)) 
                     {{ Form::text('title_3', $b->title3, ['class' => 'form-control', 'placeholder' => 'Title 3'])  }}
                    @endif

                    @if(empty($b->title3)) 
                     {{ Form::text('title_3', null, ['class' => 'form-control', 'placeholder' => 'Title 3'])  }}
                    @endif
    
                 </div>
               </div>

                <div class="form-group">
                    {{ Form::label('brand_txt_3', 'TEXT 3 CONTENT:') }}
                     @if(!empty($b->desc3)) 
                    <textarea name="brand_txt_3" required>{{ $b->desc3 }}</textarea>
                    @endif

                    @if(empty($b->desc3)) 
                    <textarea name="brand_txt_3" required></textarea>
                    @endif

                    <script>
                        CKEDITOR.replace( 'brand_txt_3' );
                    </script>
                </div>




                 {{ Form::label('title_4', 'TITLE 4:')  }}
               <div class="form-group">
                 <div class='input-group'  style="width:100%;">
                     @if(!empty($b->title4)) 
                     {{ Form::text('title_4', $b->title4, ['class' => 'form-control', 'placeholder' => 'Title 4'])  }}
                    @endif

                    @if(empty($b->title4)) 
                     {{ Form::text('title_4', null, ['class' => 'form-control', 'placeholder' => 'Title 4'])  }}
                    @endif
    
                 </div>
               </div>

                <div class="form-group">
                    {{ Form::label('brand_txt_4', 'TEXT 4 CONTENT:') }}
                     @if(!empty($b->desc4)) 
                    <textarea name="brand_txt_4" required>{{ $b->desc4 }}</textarea>
                    @endif

                    @if(empty($b->desc4)) 
                    <textarea name="brand_txt_4" required></textarea>
                    @endif

                    <script>
                        CKEDITOR.replace( 'brand_txt_4' );
                    </script>
                </div>




                 {{ Form::label('title_5', 'TITLE 5:')  }}
               <div class="form-group">
                 <div class='input-group'  style="width:100%;">
                     @if(!empty($b->title5)) 
                     {{ Form::text('title_5', $b->title5, ['class' => 'form-control', 'placeholder' => 'Title 5'])  }}
                    @endif

                    @if(empty($b->title5)) 
                     {{ Form::text('title_5', null, ['class' => 'form-control', 'placeholder' => 'Title 5'])  }}
                    @endif
    
                 </div>
               </div>

                <div class="form-group">
                    {{ Form::label('brand_txt_5', 'TEXT 5 CONTENT:') }}
                     @if(!empty($b->desc5)) 
                    <textarea name="brand_txt_5" required>{{ $b->desc5 }}</textarea>
                    @endif

                    @if(empty($b->desc5)) 
                    <textarea name="brand_txt_5" required></textarea>
                    @endif

                    <script>
                        CKEDITOR.replace( 'brand_txt_5' );
                    </script>
                </div>

                <input type="submit" value="SAVE CHANGES" class="btn btn-primary button">

            {{ Form::close() }}
        @endforeach
        </div>
    </div>
 </div>

@stop