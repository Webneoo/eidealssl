@extends('cms.layouts.default')

@section('content')
    <div class="row">
        <div class="col-lg-12">  <h1 class="page-header">Create a new brand </h1>   </div>
    </div>

    @include('cms.layouts.partials.errors')
    @include('flash::message')

<div class="panel panel-primary">
    <div class="panel-heading">
        ADD THE CONTENT OF THE NEW BRAND
    </div>
    <div class="panel-body">
        <div class="col-lg-10">
         

            {{ Form::open(['route' => 'create_brand_path', 'role' => 'form', 'files' => true]) }}

                 {{ Form::label('brand_title', 'BRAND TITLE:')  }}
               <div class="form-group">
            
                 <div class='input-group' style="width:100%;">
                     {{ Form::text('brand_title', null, ['class' => 'form-control', 'placeholder' => 'Brand title'])  }}
                 </div>
               </div>

               <div class="form-group" >
                    {{ Form::label('brand_logo', 'ABOUT US IMAGE: (Image size 156 x 64 px)')  }}
                    {{ Form::file('brand_logo', null, ['class' => 'form-control'])  }}
              </div>
           

              {{ Form::label('title_1', 'TITLE 1:')  }}
               <div class="form-group">
                
                 <div class='input-group'  style="width:100%;">
                     {{ Form::text('title_1', null, ['class' => 'form-control', 'placeholder' => 'Title 1'])  }}
                 </div>
               </div>

               <div class="form-group">
                    {{ Form::label('brand_txt_1', 'TEXT 1 CONTENT:') }}
                    <textarea name="brand_txt_1" required></textarea>
                    <script>
                        CKEDITOR.replace( 'brand_txt_1' );
                    </script>
                </div>

                {{ Form::label('title_2', 'TITLE 2:')  }}
               <div class="form-group">

                 <div class='input-group'  style="width:100%;">
                     {{ Form::text('title_2', null, ['class' => 'form-control', 'placeholder' => 'Title 2'])  }}
                 </div>
               </div>

                <div class="form-group">
                    {{ Form::label('brand_txt_2', 'TEXT 2 CONTENT:') }}
                   <textarea name="brand_txt_2" required></textarea>
                    <script>
                        CKEDITOR.replace( 'brand_txt_2' );
                    </script>
                </div>

                {{ Form::label('title_3', 'TITLE 3:')  }}
               <div class="form-group">
                 <div class='input-group'  style="width:100%;">
                     {{ Form::text('title_3', null, ['class' => 'form-control', 'placeholder' => 'Title 3'])  }}
                 </div>
               </div>

                <div class="form-group">
                    {{ Form::label('brand_txt_3', 'TEXT 3 CONTENT;') }}
                    <textarea name="brand_txt_3" required> </textarea>
                    <script>
                        CKEDITOR.replace( 'brand_txt_3' );
                    </script>
                </div>


                {{ Form::label('title_4', 'TITLE 4:')  }}
               <div class="form-group">
                 <div class='input-group'  style="width:100%;">
                     {{ Form::text('title_4', null, ['class' => 'form-control', 'placeholder' => 'Title 4'])  }}
    
                 </div>
               </div>

                <div class="form-group">
                    {{ Form::label('brand_txt_4', 'TEXT 4 CONTENT;') }}
                    <textarea name="brand_txt_4" required> </textarea>
                    <script>
                        CKEDITOR.replace( 'brand_txt_4' );
                    </script>
                </div>

                {{ Form::label('title_5', 'TITLE 5:')  }}
               <div class="form-group">
                 <div class='input-group'  style="width:100%;">
                     {{ Form::text('title_5', null, ['class' => 'form-control', 'placeholder' => 'Title 5'])  }}
    
                 </div>
               </div>

                <div class="form-group">
                    {{ Form::label('brand_txt_5', 'TEXT 5 CONTENT;') }}
                    <textarea name="brand_txt_5" required> </textarea>
                    <script>
                        CKEDITOR.replace( 'brand_txt_5' );
                    </script>
                </div>

                <input type="submit" value="SAVE CHANGES" class="btn btn-primary button">

            {{ Form::close() }}
        
        </div>
    </div>
 </div>

@stop