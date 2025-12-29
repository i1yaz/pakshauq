<div class="container-fluid content">
    @if (isset($activeNews) && $activeNews->isNotEmpty())
    <section class="content-header">
      <div class="row" style="background-color: #ff0000; padding: 10px; border-radius: 5px;">
          <div class="col-lg-12">
              <marquee class="mt-2 pb-2" style="color:white; line-height: 1.8; padding-top: 8px;" direction="right">
                @foreach ($activeNews as $news)
                  <b style="font-size:25px">
                        {{$news->name}}
                  </b>
                  @endforeach
              </marquee>
          </div>
      </div>
    </section>
    @endif
</div>
