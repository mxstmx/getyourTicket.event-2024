@extends('eventmie::layouts.app')

@section('title') @lang('eventmie-pro::em.home') @endsection

@section('content')
    @php
        $perPage = 3;
    @endphp 
<!-- Overlay - Global --> 

<!-- Section - Home -->
<section class="ln-section d-flex js-min-vh-100" data-anchor="home" data-tooltip="Home">
  <div class="container align-self-center text-center text-white">
    <div class="row">
      <div class="col-12 col-xl-9 mx-auto">
        <h1 class="mb-4 animated" data-animation="fadeInUp">Eine Plattform, unendliche Events: <b>GetYourTicket.events</b> - Dein Ticket zu unvergesslichen Erlebnissen!</h1>
        <p class="mb-7 animated" data-animation="fadeInUp" data-animation-delay="200"> Willkommen bei <b>GetYourTicket.events</b>, der ultimativen Plattform für Veranstalter und Besucher gleichermaßen. Tauche ein in eine Welt voller Möglichkeiten – von aufregenden Festivals bis hin zu gemütlichen Kinobesuchen. Mit uns wird die Organisation deines nächsten Events zum Kinderspiel.</p>
        <a href="#our-mission" class="btn btn-primary mr-3 scrollto animated" data-animation="fadeInUp" data-animation-delay="400">Mehr erfahren</a>
        <button type="button" class="btn btn-soft-white scrollto animated" data-animation="fadeInUp" data-animation-delay="600" data-toggle="modal" data-target="#subscribeModal">Jetzt Starten</button>
      </div>
    </div>
  </div>
</section>

<!-- Section - Our mission -->
<section class="ln-section d-xl-flex" data-anchor="mission"  data-tooltip="mission">
  <div class="overlay overlay-advanced">
    <div class="overlay-inner bg-primary opacity-100"></div>
  </div>
  <div class="container align-self-xl-center text-white">
    <div class="row">
      <div class="col-12 col-xl-8">
        <h3 class="h4 mb-0">Event-Ticketing-System nach deinen Vorstellungen</h3>
        <h2 class="mb-4 animated" data-animation="fadeInUp" data-animation-delay="150">Die Zukunft des Ticketings</h2>
        <p class="animated" data-animation="fadeInUp" data-animation-delay="150">Entdecke mit uns eine neue Ära im Ticketverkauf. Wir revolutionieren dein Eventmanagement, ohne überflüssigen Ballast, ohne einschränkende Verträge, ohne Kompromisse. Erlebe mit uns die Entstehung einzigartiger Events, gestaltet durch bedarfsgerechte Software und herausragenden Service – von Menschen für Menschen.</p>
      </div>
    </div>
  </div>
</section>

<!-- Section - What we do -->
<section class="ln-section d-xl-flex" data-anchor="why" data-tooltip="why">
  <div class="container align-self-xl-center text-white">
    <div class="row">
      <div class="col-12 col-xl-6 mb-8 mb-xl-0">
        <h2 class="animated mb-16" data-animation="fadeInUp">Die inneren Werte zählen: Warum dein Ticketing bei uns in den besten Händen ist</h2>
        <div class="row">
          <div class="col-md-6 col-sm-6 mb-8 mb-sm-0 animated" data-animation="fadeInUp" data-animation-delay="600">
            <div class="icon-7x mb-4"> <i class="ti-settings"></i> </div>
            <h3 class="h4 mb-0">Einlass</h3>
            <p>Benötigst du personelle Unterstützung am Einlass oder Hardware zur Ticketentwertung? Gemeinsam evaluieren wir deine Bedürfnisse und entwickeln die optimale Strategie für dein Einlassmanagement.</p>
          </div>
          <div class="col-md-6 col-sm-6 animated" data-animation="fadeInUp" data-animation-delay="750">
            <div class="icon-7x mb-4"> <i class="ti-headphone-alt"></i> </div>
            <h3 class="h4 mb-0">Payment</h3>
            <p>Profitiere von der Vielzahl angebundener Zahlungsanbieter in deinem Shop und nutze Cashless Payment für bargeldlose Transaktionen. Setze auf die GetYourTicket.events Tageskasse, um Tickets am POS zu verkaufen!</p>
          </div>
        </div>
      </div>
      <div class="col-12 col-xl-6">
        <div class="row">
          <div class="col-md-6 col-sm-6 mb-8 animated" data-animation="fadeInUp">
            <div class="icon-7x mb-4"> <i class="ti-timer"></i> </div>
            <h3 class="h4 mb-0">Ticketshop</h3>
            <p>Unsere leistungsstarken Ticketshops sind SEO-optimiert, DSGVO-konform und flexibel konfigurierbar. Setze auf GetYourTicket.events, um das optimale Kauferlebnis zu bieten.</p>
          </div>
          <div class="col-md-6 col-sm-6 mb-8 animated" data-animation="fadeInUp" data-animation-delay="150">
            <div class="icon-7x mb-4"> <i class="ti-brush-alt"></i> </div>
            <h3 class="h4 mb-0">Marketing</h3>
            <p>Erstelle mit unserem Event Ticketing System maßgeschneiderte Kampagnen über Social Media, Google und mehr. Mit zielgruppenorientiertem Marketing kannst du deinen Verkäufen einen Schub verleihen.</p>
          </div>
          <div class="col-md-6 col-sm-6 mb-8 animated" data-animation="fadeInUp" data-animation-delay="300">
            <div class="icon-7x mb-4"> <i class="ti-book"></i> </div>
            <h3 class="h4 mb-0">Datenanalyse</h3>
            <p >Data is Key! Durch die Analyse von Daten erhältst du ein besseres Verständnis für Ticketkäufer:innen. Triff fundiertere Entscheidungen und bewirb Events gezielter, um mehr Tickets zu verkaufen</p>
          </div>
          <div class="col-md-6 col-sm-6 mb-8 animated" data-animation="fadeInUp" data-animation-delay="450">
            <div class="icon-7x mb-4"> <i class="ti-layers"></i> </div>
            <h3 class="h4 mb-0">Controlling</h3>
            <p>Behalte die Übersicht über deine Umsatzzahlen, Absatzkanäle und aufbereitete Daten zu Besucherströmen. Unsere Wallet-Technologie schützt vor Betrug und sichert deine Umsätze rechtskonform.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Section - Our solutions -->
<section class="ln-section d-xl-flex" data-anchor="advantages" data-tooltip="advantages">
  <div class="overlay overlay-advanced">
    <div class="overlay-inner bg-primary opacity-90"></div>
  </div>
  <div class="container align-self-xl-center text-white">
    <div class="row mb-8">
      <div class="col-12 col-xl-9">
        <h2 class="mb-4 animated" data-animation="fadeInUp">Deine Vorteile bei GetYourTicket.events</h2>
        <p class="animated" data-animation="fadeInUp" data-animation-delay="150">Ganz gleich, in welcher Branche du aktiv bist – wir stehen dir zur Seite, um deine Event-Träume zu verwirklichen. Vom Account Management bis hin zum zielgruppenorientierten Marketing bieten wir ein umfassendes Event-ABC, das speziell auf die Anforderungen deiner Branche zugeschnitten ist. Überzeuge dich selbst von unserem Event Ticketing System!</p>
      </div>
    </div>
    <div class="row">
      <div class="col-12 col-lg-4 mb-8 animated" data-animation="fadeInUp" data-animation-delay="150">
        <h4>Faires Pricing</h4>
        <p class="mb-0">Bei GetYourTicket.events findest du immer genau den Preis, der zu dir und deinem Event passt! Unser Pricing ist transparent und bietet Kosten auf Augenhöhe.</p>
      </div>
      <div class="col-12 col-lg-4 mb-8 animated" data-animation="fadeInUp" data-animation-delay="300">
        <h4>Support nach Maß</h4>
        <p class="mb-0">Bei uns hast du immer persönliche Ansprechpartner:innen an deiner Seite, die sich um alle Anliegen rund um dein Event-Ticketing kümmern.</p>
      </div>
      <div class="col-12 col-lg-4 mb-8 animated" data-animation="fadeInUp" data-animation-delay="450">
        <h4>Abgesichert</h4>
        <p class="mb-0">Safety First! Alle Einnahmen und Auszahlungen werden zu 100 % über Treuhandkonten abgewickelt und sind für dich transparent einsehbar.</p>
      </div>
    </div>
  </div>
</section>

<!-- Section - Our work -->
<section class="ln-section d-xl-flex" data-anchor="solutions" data-tooltip="solutions">
  <div class="overlay overlay-advanced">
    <div class="overlay-inner bg-secondary opacity-90"></div>
  </div>
  <div class="container align-self-xl-center text-white ">
    <div class="row mb-8">
      <div class="col-12 col-xl-8">
        <h3 class="h4 mb-0">Umfassend aufgesetzt und Expertenberatung inklusive:</h3>
        <h2 class="animated mb-4" data-animation="fadeInUp">Für alle Branchen geeignet</h2>
        <p class="animated" data-animation="fadeInUp" data-animation-delay="150">Ganz gleich, in welcher Branche du aktiv bist – wir stehen dir zur Seite, um deine Event-Träume zu verwirklichen. Vom Account Management bis hin zum zielgruppenorientierten Marketing bieten wir ein umfassendes Event-ABC, das speziell auf die Anforderungen deiner Branche zugeschnitten ist. Überzeuge dich selbst von unserem Event Ticketing System!</p>
      </div>
    </div>
    <div class="slider dots-light animated" data-animation="fadeInUp" data-animation-delay="300" data-slick="{'dots': true}">
      <div>
        <div class="portfolio-item mb-8">
          <div class="row">
            <div class="col-12 col-lg-7 mb-4 mb-lg-0">
              <div class="item-media"> <a href="assets/images/portfolio/project-6.jpg" class="mfp-image">
                <div class="media-container">
                  <div class="bg-image-holder bg-cover"> <img src="assets/images/portfolio/project-6-min.jpg" alt=""> </div>
                </div>
                </a> </div>
            </div>
            <div class="col-12 col-lg-5">
              <div class="pt-lg-8">
                <div class="divider divider-alt bg-white mt-0 mb-8 d-none d-lg-block"></div>
                <h4 class="h3">Festival</h4>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div>
        <div class="portfolio-item mb-8">
          <div class="row flex-lg-row-reverse">
            <div class="col-12 col-lg-7 mb-4 mb-lg-0">
              <div class="item-media"> <a href="assets/images/portfolio/project-1.jpg" class="mfp-image">
                <div class="media-container">
                  <div class="bg-image-holder bg-cover"> <img src="assets/images/portfolio/project-1-min.jpg" alt=""> </div>
                </div>
                </a> </div>
            </div>
            <div class="col-12 col-lg-5 d-lg-flex justify-content-lg-end text-lg-right">
              <div class="pt-lg-8">
                <div class="divider divider-alt bg-white mt-0 mb-8 ml-auto mr-0 d-none d-lg-block"></div>
                <h4 class="h3">Club</h4>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div>
        <div class="portfolio-item mb-8">
          <div class="row">
            <div class="col-12 col-lg-7 mb-4 mb-lg-0">
              <div class="item-media"> <a href="assets/images/portfolio/project-2.jpg" class="mfp-image">
                <div class="media-container">
                  <div class="bg-image-holder bg-cover"> <img src="assets/images/portfolio/project-2-min.jpg" alt=""> </div>
                </div>
                </a> </div>
            </div>
            <div class="col-12 col-lg-5">
              <div class="pt-lg-8">
                <div class="divider divider-alt bg-white mt-0 mb-8 d-none d-lg-block"></div>
                <h4 class="h3">Entertaiment &amp; Musik</h4>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div>
        <div class="portfolio-item mb-8">
          <div class="row flex-lg-row-reverse">
            <div class="col-12 col-lg-7 mb-4 mb-lg-0">
              <div class="item-media"> <a href="assets/images/portfolio/project-3.jpg" class="mfp-image">
                <div class="media-container">
                  <div class="bg-image-holder bg-cover"> <img src="assets/images/portfolio/project-3-min.jpg" alt=""> </div>
                </div>
                </a> </div>
            </div>
            <div class="col-12 col-lg-5 d-lg-flex justify-content-lg-end text-lg-right">
              <div class="pt-lg-8">
                <div class="divider divider-alt bg-white mt-0 mb-8 ml-auto mr-0 d-none d-lg-block"></div>
                <h4 class="h3">Kultur</h4>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div>
        <div class="portfolio-item">
          <div class="row">
            <div class="col-12 col-lg-7 mb-4 mb-lg-0">
              <div class="item-media"> <a href="assets/images/portfolio/project-4.jpg" class="mfp-image">
                <div class="media-container">
                  <div class="bg-image-holder bg-cover"> <img src="assets/images/portfolio/project-4-min.jpg" alt=""> </div>
                </div>
                </a> </div>
            </div>
            <div class="col-12 col-lg-5">
              <div class="pt-lg-8">
                <div class="divider divider-alt bg-white mt-0 mb-8 d-none d-lg-block"></div>
                <h4 class="h3">Sport</h4>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Section - Contact -->
<section class="ln-section d-xl-flex" data-anchor="contact" data-tooltip="Contact">
  <div class="container align-self-center text-white">
    <div class="row mb-7">
      <div class="col-12 col-xl-6">
        <h2 class="mb-4 animated" data-animation="fadeInUp">Kontakt</h2>
        <p class="animated" data-animation="fadeInUp" data-animation-delay="150">Nimm jetzt Kontakt mit uns auf oder vereinbare einen Demo-Termin mit unseren Expert:innen. Erfahre, warum die erfolgreichsten Veranstalter:innen mit GetYourTicket.events zusammenarbeiten und unser Event Ticketing System nutzen.</p>
      </div>
    </div>
    <div class="row">
      <div class="col-12 col-lg-5 mb-8 mb-lg-0">
        <div class="row">
          <div class="col-12 col-md-4 col-lg-6 mb-8 mb-md-0 mb-lg-5 animated" data-animation="fadeInUp" data-animation-delay="150">
            <div class="icon-5x mb-4"> <i class="ti-location-pin"></i> </div>
            <p class="mb-0">Am Schürmannshütt 30, 47441 Moers</p>
          </div>
          <div class="col-12 col-md-4 col-lg-6 animated" data-animation="fadeInUp" data-animation-delay="150">
            <div class="icon-5x mb-4"> <i class="ti-email"></i> </div>
            <p class="mb-0"><a href="mailto:support@getyourticket.events" class="text-white">support@getyourticket.events</a><br/>
              <a href="mailto:hello@egetyourticket.events" class="text-white">hello@egetyourticket.events</a></p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection