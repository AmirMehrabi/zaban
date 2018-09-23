@extends('layouts.simple')

@section('title', 'صفحه نخست')



@section('content')

<img src="{{url($picture)}}" alt="">

<section class="section-b shadow-2" >
  <div class="container">
    <div class="row text-center pt-4 pb-4">
      <div class="col-md-12 mb-5">
        <h2>بهترین راه برای یادگیری زبان</h2>
      </div>
      <div class="col-md-3">
        <i class="fa fa-globe fa-4x" aria-hidden="true"></i>
        <h6 class="pt-4">از هر جا و هر مکان</h6>
        <p class="small text-justify  bg-color">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. </p>
      </div>
      <div class="col-md-3">
        <i class="fa fa-dollar fa-4x" aria-hidden="true"></i>
        <h6 class="pt-4">کاهش هزینه ها</h6>
        <p class="small text-justify  bg-color">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. </p>
      </div>
      <div class="col-md-3">
        <i class="fa fa-line-chart fa-4x" aria-hidden="true"></i>
        <h6 class="pt-4">افزایش بهره وری</h6>
        <p class="small text-justify  bg-color">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. </p>
      </div>
      <div class="col-md-3">
        <i class="fa fa-calendar-check-o fa-4x" aria-hidden="true"></i>
        <h6 class="pt-4">صرفه جویی در زمان</h6>
        <p class="small text-justify  bg-color">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. </p>
      </div>
    </div>
  </div>
</section>

<section class="section-a shadow-2">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <form>
          <fieldset class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" class="form-control" id="exampleInputEmail1"  data-validation="required" placeholder="Enter email">
            <small class="text-muted">We'll never share your email with anyone else.</small>
          </fieldset>
          <fieldset class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
          </fieldset>
          <fieldset class="form-group">
            <label for="exampleSelect1">Example select</label>
            <select class="form-control" id="exampleSelect1">
              <option>1</option>
              <option>2</option>
              <option>3</option>
              <option>4</option>
              <option>5</option>
            </select>
          </fieldset>
          <fieldset class="form-group">
            <label for="exampleSelect2">Example multiple select</label>
            <select multiple class="form-control" id="exampleSelect2">
              <option>1</option>
              <option>2</option>
              <option>3</option>
              <option>4</option>
              <option>5</option>
            </select>
          </fieldset>
          <fieldset class="form-group">
            <label for="exampleTextarea">Example textarea</label>
            <textarea class="form-control" id="exampleTextarea" rows="3"></textarea>
          </fieldset>
          <fieldset class="form-group">
            <label for="exampleInputFile">File input</label>
            <input type="file" class="form-control-file" id="exampleInputFile">
            <small class="text-muted">This is some placeholder block-level help text for the above input. It's a bit lighter and easily wraps to a new line.</small>
          </fieldset>
          <div class="radio">
            <label>
              <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>
              Option one is this and that&mdash;be sure to include why it's great
            </label>
          </div>
          <div class="radio">
            <label>
              <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
              Option two can be something else and selecting it will deselect option one
            </label>
          </div>
          <div class="radio disabled">
            <label>
              <input type="radio" name="optionsRadios" id="optionsRadios3" value="option3" disabled>
              Option three is disabled
            </label>
          </div>
          <div class="checkbox">
            <label>
              <input type="checkbox"> Check me out
            </label>
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </div>
</section>


@endsection


@section('footer-assets')
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
  <script>

      // Add validator
      $.formUtils.addValidator({
          name : 'even',
          validatorFunction : function(value, $el, config, language, $form) {
              return parseInt(value, 10) % 2 === 0;
          },
          errorMessage : 'You have to answer an even number',
          errorMessageKey: 'badEvenNumber'
      });

      // Initiate form validation
      $.validate();

  </script>
@endsection
