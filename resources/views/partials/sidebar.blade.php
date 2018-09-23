<div class="sidebar">
  <a href="{{route('topic.add')}}" class="btn btn-success btn-lg btn-block br-2"><i class="fa fa-plus" aria-hidden="true"></i> طرح پرسش جدید</a>
  <br><hr><br>

  <div class="row">
    <div class="col-md-12">
      <div class="categories">
        <h4 class="widget-title "><span>دسته‌بندی‌ها</span></h4>
        <a href="{{route('category.contract')}}" class="btn btn-primary btn-category btn-block">قرارداد</a>
        <a href="{{route('category.debt')}}" class="btn btn-primary btn-category btn-block">وصول مطالبات</a>
        <a href="{{route('category.criminal')}}" class="btn btn-primary btn-category btn-block">کیفری</a>
        <a href="{{route('category.judical')}}" class="btn btn-primary btn-category btn-block">قضایی</a>
        <a href="{{route('category.civilian')}}" class="btn btn-primary btn-category btn-block">ملکی</a>
        <a href="{{route('category.domestic')}}" class="btn btn-primary btn-category btn-block">خانوادگی</a>
        <a href="{{route('category.registration')}}" class="btn btn-primary btn-category btn-block">ثبت احوال</a>
      </div>

    </div>
  </div>

  <br><hr><br>
  <div class="row">
    <div class="col-md-12">
      <div class="featured">
        <h4 class="widget-title "><span>پر بازدیدترین ها</span></h4>
        <ul class="list-unstyled">
          @foreach ($featured_topics as $featured_topic)
            <li class="featured-li"><a href="{{route('topic', $featured_topic->slug)}}">{{$featured_topic->title}}</a></li>
          @endforeach
        </ul>
      </div>
    </div>
  </div>
</div>
