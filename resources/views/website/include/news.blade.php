<style>
    .notice-row {
        background-color: #ff0000;
        border-radius: 5px;
        margin: 0;
    }

    .notice-row>div {
        padding: 0;
    }

    .notice-ticker {
        overflow: hidden;
        white-space: nowrap;
        padding: 6px 0;
    }

    .notice-track {
        display: inline-flex;
        align-items: center;
        animation: notice-scroll 25s linear infinite;
        will-change: transform;
    }

    .notice-item {
        font-size: 25px;
        font-weight: 700;
        color: #ffffff;
        margin-right: 40px;
        white-space: nowrap;
    }

    /* animation */
    @keyframes notice-scroll {
        from {
            transform: translateX(100%);
        }

        to {
            transform: translateX(-100%);
        }
    }
</style>

<div class="container-fluid content">
    @if (isset($activeNews) && $activeNews->isNotEmpty())
        <section class="content-header">
            <div class="row notice-row">
                <div class="col-lg-12 p-0">
                    <div class="notice-ticker">
                        <div class="notice-track">
                            @foreach ($activeNews as $news)
                                <span class="notice-item">{{ $news->name }}</span>
                            @endforeach

                            {{-- duplicate for seamless loop --}}
                            @foreach ($activeNews as $news)
                                <span class="notice-item">{{ $news->name }}</span>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
</div>
