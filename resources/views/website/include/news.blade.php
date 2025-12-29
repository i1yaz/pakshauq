<div class="container-fluid content">
    @if (isset($activeNews) && $activeNews->isNotEmpty())
    <section class="content-header">
      <div class="row" style="background-color: #d1ecf1; padding: 10px; border-radius: 5px;">
          <div class="col-lg-12">
              <marquee class="mt-2 pb-2" direction="right">
                @foreach ($activeNews as $news)
                  <b style="font-size:20px">
                        {{$news->name}}
                  </b>
                  @endforeach
              </marquee>
          </div>
      </div>
    </section>
    @endif
</div>
