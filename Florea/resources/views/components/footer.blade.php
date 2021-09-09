<footer class="footer mt-auto py-3" style="margin-top: auto;">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <h4>Nos autres pages</h4>
                {{menu('FooterLinks')}}
                <h4>Nos partenaires</h4>
                <ul>
                    <li>
                        <a href="https://geoffreymotte.fr" target="_blank">Geoffrey Motte</a>
                    </li>
                    <li>
                        <a href="https://remygalopin.fr" target="_blank">Rémy Galopin</a>
                    </li>
                    <li><a href="https://antoncovu.fr" target="_blank">Anton covu</a></li>
                    <li><a href="https://quentin-magnier.fr" target="_blank">Quentin magnier</a></li>
                </ul>
            </div>
            <div class="col-lg-5">
                <div class="row">
                    <div class="col-10">
                        <h4 class="mb-4">Suivez-nous !</h4>
                        <ul class="social d-flex justify-content-start align-items-center">
                            <li class="h-1">
                                <a href="#" target="_blank">
                                    <img src="{{Voyager::image('assets/email.svg')}}" />
                                </a>
                            </li>
                            <li class="h-1">
                                <a href="#" target="_blank">
                                    <img src="{{Voyager::image('assets/github.svg')}}" />
                                </a>
                            </li>
                            <li class="h-1">
                                <a href="#" target="_blank">
                                    <img src="{{Voyager::image('assets/linkedin.svg')}}" />
                                </a>
                            </li>
                            <li class="h-1">
                                <a href="#" target="_blank">
                                    <img src="{{Voyager::image('assets/bitbucket.svg')}}" />
                                </a>
                            </li>
                            <li class="h-1">
                                <a href="#" target="_blank">
                                    <img src="{{Voyager::image('assets/twitter.svg')}}" />
                                </a>
                            </li>
                            <li class="h-1">
                                <a href="#" target="_blank">
                                    <img src="{{Voyager::image('assets/instagram.svg')}}" />
                                </a>
                            </li>
                            <li class="h-1">
                                <a href="#" target="_blank">
                                    <img src="{{Voyager::image('assets/facebook.svg')}}" />
                                </a>
                            </li>
                        </ul>
                        <h4 class="mt-5">Restons en contact</h4>
                            <form class="d-flex" action="{{route('newsletter.post')}}" method="POST" id="newsletter">
                                @csrf
                                <input name="newsletter_email" class="form-control me-2 my-2 no-bg bordered-green color-green @error('newsletter_email', 'newsletter') is-invalid @enderror" type="email" placeholder="Adresse E-mail" aria-label="Adresse E-mail" value="{{old('newsletter_email') ?? ''}}">
                                <input class="btn btn-primary my-2" type="submit" value="s'inscrire" name="submitNews">
                            </form>
                            <div class="invalid-feedback">
                                @error('newsletter_email', 'newsletter')
                                    {{ $message }}
                                @enderror
                            </div>
                            <a href="{{route('newsletter.unsub')}}" class="fsz-10">Se désinscrire</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <h4>Nous contacter</h4>
                    <ul class="adress">
                        <li class="row">
                            <div class="col-2"><span class="small-img"><img src="{{Voyager::image('assets/loc.svg')}}" style="max-height: 36px;" /></span></div>
                            <div class="col-10 fsz-16"><a href="https://www.google.com/maps/search/+2+rue+Nic%C3%A9phore+Niepce+%3Cbr%3E+60200+Compi%C3%A8gne" target="_blank"> 2 rue Nicéphore Niepce <br> 60200 Compiègne</a></div>
                        </li>
                        <li class="row">
                            <div class="col-2"><span class="small-img"><img src="{{Voyager::image('assets/phone.svg')}}" style="max-height: 36px;" /></span></div>
                            <div class="col-10 fsz-16"><a href="tel:+33344533146">03 44 53 31 46</a></div>
                        </li>
                        <li class="row">
                            <div class="col-2"><span class="small-img"><img src="{{Voyager::image('assets/mail.svg')}}" style="max-height: 36px;" /></span></div>
                            <div class="col-10 fsz-16"><a href="mailto:contact@media-management.fr">contact@media-management.fr</a></div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
</footer>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous" defer></script>
</body>

</html>