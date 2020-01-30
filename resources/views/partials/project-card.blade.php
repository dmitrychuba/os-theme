<div class="project-card__wrapper p-3" data-animate="flipInX:{{ 4*rand(5,10)/20 }}s,{{ 5 + 3*rand(5,10)/50 }}s">
    <div class="project-card">
        <a class="project-card__link abs-cover" href="#"></a>
        <div class="project-card__thumb" style="background-image: url('https://source.unsplash.com/360x200?{{ ['volcano','nature','birds','animals'][rand(0,3)] }}{{ '&'.rand() }}')"></div>
        <div class="project-card__layer abs-cover"></div>
        <div class="project-card__summary abs-cover">
            <span class="project-card__meta category">{{ $faker->sentence(2) }}</span>
            <h2 class="project-card__title">{{ $faker->catchPhrase }}</h2>
            <address class="project-card__meta author">{{ $faker->name }}</address>
        </div>
    </div>
    {!! $slot ?? null !!}
</div>
