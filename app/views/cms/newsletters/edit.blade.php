@extends('cms.layouts.default')

@section('content')
    <div class="row">
        <div class="col-lg-12">  <h1 class="page-header">Newsletters </h1>   </div>
    </div>

    @include('cms.layouts.partials.errors')
    @include('flash::message')

<div class="panel panel-primary">
    <div class="panel-heading">
        EDIT THE CONTENT OF NEWSLETTERS
    </div>

    <br/>
    <div class="panel panel-success ">
      <div class="panel-heading">List of emails subscribed to Newsletters</div>
      <div id="mails" class="panel-body">
      
      <?php 
          
          $i = 0; 

          foreach($newsletters_email_list as $e)
          { 
            if($i==0)
            $list = $e->email;
          
            else   
            $list = $list.', '. $e->email; 

            $i++;
          }

           rtrim($list, ",");

           echo $list;
      ?>

      
      </div>

    </div>


    <div class="panel-body">
        <div class="col-lg-10">
          @foreach($newsletters_info as $n)

            {{ Form::open(['route' => 'newsletters_management_path', 'role' => 'form']) }}

               <div class="form-group">
                    {{ Form::label('title', 'Title') }}
                    {{ Form::text('title', $n->newsletters_title, ['class' => 'form-control', 'placeholder' => 'Title', 'required' => 'required'])  }}
                </div>

              <div class="form-group">
                    {{ Form::label('content', 'Text:') }}
                    <textarea name="content" required>{{ $n->newsletters_text }}</textarea>
                    <script>
                        CKEDITOR.replace( 'content' );
                    </script>
                </div>

                <br/><br/>


                <input type="submit" value="SAVE CHANGES" class="btn btn-primary button">

            {{ Form::close() }}
        @endforeach
        </div>
    </div>
 </div>



 <script type="text/javascript">
     $("#select_all").click(function () {

    $("#mails").focus();
});
 </script>


@stop