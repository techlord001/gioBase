@extends('layouts.app')

@php
    $titleExt = " | FAQs";
@endphp

@section('content')
    <div class="container" id="faqAccordion">
        <div class="accordion">
            <div class="card gbCard">
                <div class="card-header gbCard-header">
                    <button class="btn btn-link stretched-link gbCard-header-link" data-toggle="collapse" data-target="#item1"><h5 class="m-0">What is GioBase?</h5></button>
                </div>
                <div class="collapse" id="item1" data-parent="#faqAccordion">
                    <div class="card-body gbCard-body">
                        GioBase is the world's first and only dedicated database to the musical genre of Vaporwave, specifically geared towards collectors of the works of Vaporwave artists. With the help of dedicated admins and contributors our carefully curated database contains information about labels, their artists and more importantly their records, all available at the touch of a button. 
                    </div>
                </div>
            </div>
            <div class="card gbCard">
                <div class="card-header gbCard-header">
                    <button class="btn btn-link stretched-link gbCard-header-link" data-toggle="collapse" data-target="#item2"><h5 class="m-0">GioBase is for collectors?</h5></button>
                </div>
                <div class="collapse" id="item2" data-parent="#faqAccordion">
                    <div class="card-body">
                        That's right! Not specifically, but primarily GioBase is built with Vaporwave record collectors in mind. Become a member by registering with us; you'll then be able to keep and track your collection tied entirely to your profile.
                    </div>
                </div>
            </div>
            <div class="card gbCard">
                <div class="card-header gbCard-header">
                    <button class="btn btn-link stretched-link gbCard-header-link" data-toggle="collapse" data-target="#item3"><h5 class="m-0">How does it work?</h5></button>
                </div>
                <div class="collapse" id="item3" data-parent="#faqAccordion">
                    <div class="card-body">
                        Simply register an account (all you need is a working email address) and once verified simply browse the records list and add any you own to your collection by clicking the "Add to Collection" button. There's also a "Add to Wishlist" button if you have any records in your line of sight for the future. And that's it!
                    </div>
                </div>
            </div>
            <div class="card gbCard">
                <div class="card-header gbCard-header">
                    <button class="btn btn-link stretched-link gbCard-header-link" data-toggle="collapse" data-target="#item4"><h5 class="m-0">Do I need to register to use your sight?</h5></button>
                </div>
                <div class="collapse" id="item4" data-parent="#faqAccordion">
                    <div class="card-body">
                        Guests are more than welcome to browse our database to look through labels, artists, records & genres. But to get the full experience and use the sight for it's intended purpose you'll need to register.
                    </div>
                </div>
            </div>
            <div class="card gbCard">
                <div class="card-header gbCard-header">
                    <button class="btn btn-link stretched-link gbCard-header-link" data-toggle="collapse" data-target="#item5"><h5 class="m-0">How will you use my details?</h5></button>
                </div>
                <div class="collapse" id="item5" data-parent="#faqAccordion">
                    <div class="card-body">
                        The only detail we'll ever ask of you is your email address. This is simply to verify you actually exist and to log in. We may use it to send communiques to you in the future (which we will ask permission for in advance) and that's it. In fact we'd ask you when creating a username to not include any personal identifiers e.g jsmith to aid in keeping you as anonymous as possible.
                    </div>
                </div>
            </div>
            <div class="card gbCard">
                <div class="card-header gbCard-header">
                    <button class="btn btn-link stretched-link gbCard-header-link" data-toggle="collapse" data-target="#item6"><h5 class="m-0">This project sounds great! How can I help?</h5></button>
                </div>
                <div class="collapse" id="item6" data-parent="#faqAccordion">
                    <div class="card-body">
                        You can help curate our database by becoming either a Contributor or Admin. A member can only be promoted by either an Admin or Master Admin.
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection