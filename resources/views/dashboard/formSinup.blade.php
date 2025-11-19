@extends('dashboard.layouts.main')
@section('content')
<style>
    .content-wrapper{
        margin-top: 70px;
        padding: 10px;
    }
    </style>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    {{-- <div class="content-header sty-two">
      <h1 class="text-white">Sinup Form</h1>
      <ol class="breadcrumb">
        <li><a href="#">Home</a></li>
        <li><i class="fa fa-angle-right"></i> <a href="#">Form</a></li>
        <li><i class="fa fa-angle-right"></i> Sinup Form</li>
      </ol>
    </div> --}}

    <!-- Main content -->
    <div class="content">
      <div class="card">
      <div class="card-body">
        <h4 class="text-black">Basic Elements</h4>
        <div class="row">
          <div class="col-lg-4">
            <fieldset class="form-group">
              <label>Basic Input</label>
              <input class="form-control" id="basicInput" type="text">
            </fieldset>
          </div>
          <div class="col-lg-4">
            <fieldset class="form-group">
              <label>Input text with help</label>
              <small class="text-muted">eg.<i>someone@example.com</i></small>
              <input class="form-control" id="helpInputTop" type="text">
            </fieldset>
          </div>
          <div class="col-lg-4">
            <fieldset class="form-group">
              <label>Disabled Input</label>
              <input class="form-control" id="disabledInput" disabled="" type="text">
            </fieldset>
          </div>
          <div class="col-lg-4">
            <fieldset class="form-group">
              <label>Readonly Input</label>
              <input class="form-control" id="readonlyInput" readonly value="You can't update me :P" type="text">
            </fieldset>
          </div>
          <div class="col-lg-4">
            <fieldset class="form-group">
              <label>Input with Placeholder</label>
              <input class="form-control" id="placeholderInput" placeholder="Enter Email Address" type="email">
            </fieldset>
          </div>
          <div class="col-lg-4">
            <fieldset class="form-group">
              <label>Static Text</label>
              <p class="form-control-static m-bot-1" id="staticInput">email@pixinvent.com</p>
            </fieldset>
          </div>
          <div class="col-lg-4">
            <fieldset class="form-group">
              <label>Rounded Input</label>
              <input id="roundText" class="form-control round" placeholder="Rounded Input" type="text">
            </fieldset>
          </div>
          <div class="col-lg-4">
            <fieldset class="form-group">
              <label>Square Input</label>
              <input id="squareText" class="form-control square" placeholder="square Input" type="text">
            </fieldset>
          </div>
          <div class="col-lg-4">
            <fieldset class="form-group">
              <label>With Helper Text</label>
              <input id="helperText" class="form-control" placeholder="Name" type="text">
              <p> <small class="text-muted">Find helper text here for given textbox.</small> </p>
            </fieldset>
          </div>
        </div>
        <hr class="m-t-3 m-b-3">
        <h4 class="text-black">File Input</h4>
        <div class="row">
          <div class="col-lg-6">
            <div class="form-group">
              <label for="exampleInputFile">Simple File Input</label>
              <input type="file" id="exampleInputFile">
            </div>
          </div>
          <div class="col-lg-6">
            <div class="form-group">
              <fieldset class="form-group">
                <label for="file">With Browse button</label>
                <label class="custom-file center-block block">
                  <input type="file" id="file" class="custom-file-input">
                  <span class="custom-file-control"></span> </label>
              </fieldset>
            </div>
          </div>
        </div>
        <hr class="m-t-3 m-b-3">
        <h4 class="text-black">Textarea</h4>
        <div class="row">
          <div class="col-lg-4">
            <fieldset class="form-group">
              <label>Basic Textarea</label>
              <textarea class="form-control" id="basicTextarea" rows="3"></textarea>
            </fieldset>
          </div>
          <div class="col-lg-4">
            <fieldset class="form-group">
              <label>Textarea with Placeholder</label>
              <textarea class="form-control" id="placeTextarea" rows="3" placeholder="Textarea with placeholder"></textarea>
            </fieldset>
          </div>
          <div class="col-lg-4">
            <fieldset class="form-group">
              <label>Textarea with Description</label>
              <textarea class="form-control" id="descTextarea" rows="3" placeholder="Textarea with description"></textarea>
            </fieldset>
          </div>
        </div>
        <hr class="m-t-3 m-b-3">
        <h4 class="text-black">Checkbox And Radio Buttons</h4>
        <div class="row">
          <div class="col-lg-6">
            <div class="checkbox">
              <label>
                <input type="checkbox" value="">
                Option one is this and that&mdash;be sure to include why it's great </label>
            </div>
            <div class="checkbox disabled">
              <label>
                <input type="checkbox" value="" disabled>
                Option two is disabled </label>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="radio">
              <label>
                <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>
                Option one is this and that&mdash;be sure to include why it's great </label>
            </div>
            <div class="radio">
              <label>
                <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
                Option two can be something else and selecting it will deselect option one </label>
            </div>
            <div class="radio disabled">
              <label>
                <input type="radio" name="optionsRadios" id="optionsRadios3" value="option3" disabled>
                Option three is disabled </label>
            </div>
          </div>
        </div>
        <hr class="m-t-3 m-b-3">
        <h4 class="text-black">Selects</h4>
        <div class="row">
          <div class="col-lg-6">
            <select class="form-control">
              <option>1</option>
              <option>2</option>
              <option>3</option>
              <option>4</option>
              <option>5</option>
            </select>
          </div>
          <div class="col-lg-6">
            <select multiple class="form-control">
              <option>1</option>
              <option>2</option>
              <option>3</option>
              <option>4</option>
              <option>5</option>
            </select>
          </div>
        </div>
        <hr class="m-t-3 m-b-3">
        <h4 class="text-black">Validation States</h4>
        <div class="form-group has-success">
          <label class="control-label" for="inputSuccess1">Input with success</label>
          <input type="text" class="form-control" id="inputSuccess1" aria-describedby="helpBlock2">
          <span id="helpBlock2" class="help-block">A block of help text that breaks onto a new line and may extend beyond one line.</span> </div>
        <div class="form-group has-warning">
          <label class="control-label" for="inputWarning1">Input with warning</label>
          <input type="text" class="form-control" id="inputWarning1">
        </div>
        <div class="form-group has-error">
          <label class="control-label" for="inputError1">Input with error</label>
          <input type="text" class="form-control" id="inputError1">
        </div>
        <div class="has-success">
          <div class="checkbox">
            <label>
              <input type="checkbox" id="checkboxSuccess" value="option1">
              Checkbox with success </label>
          </div>
        </div>
        <div class="has-warning">
          <div class="checkbox">
            <label>
              <input type="checkbox" id="checkboxWarning" value="option1">
              Checkbox with warning </label>
          </div>
        </div>
        <div class="has-error">
          <div class="checkbox">
            <label>
              <input type="checkbox" id="checkboxError" value="option1">
              Checkbox with error </label>
          </div>
        </div>
        <hr class="m-t-3 m-b-3">
        <h4 class="text-black">Validation With Optional Icons</h4>
        <div class="form-group has-success has-feedback">
          <label class="control-label" for="inputSuccess2">Input with success</label>
          <input type="text" class="form-control" id="inputSuccess2" aria-describedby="inputSuccess2Status">
          <span class="fa fa-check form-control-feedback" aria-hidden="true"></span> <span id="inputSuccess2Status" class="sr-only">(success)</span> </div>
        <div class="form-group has-warning has-feedback">
          <label class="control-label" for="inputWarning2">Input with warning</label>
          <input type="text" class="form-control" id="inputWarning2" aria-describedby="inputWarning2Status">
          <span class="fa fa-warning form-control-feedback" aria-hidden="true"></span> <span id="inputWarning2Status" class="sr-only">(warning)</span> </div>
        <div class="form-group has-error has-feedback">
          <label class="control-label" for="inputError2">Input with error</label>
          <input type="text" class="form-control" id="inputError2" aria-describedby="inputError2Status">
          <span class="fa fa-close form-control-feedback" aria-hidden="true"></span> <span id="inputError2Status" class="sr-only">(error)</span> </div>
        <div class="form-group has-success has-feedback">
          <label class="control-label" for="inputGroupSuccess1">Input group with success</label>
          <div class="input-group"> <span class="input-group-addon">@</span>
            <input type="text" class="form-control" id="inputGroupSuccess1" aria-describedby="inputGroupSuccess1Status">
          </div>
          <span class="fa fa-check form-control-feedback" aria-hidden="true"></span> <span id="inputGroupSuccess1Status" class="sr-only">(success)</span> </div>
      </div></div>
      <!-- Main row -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection