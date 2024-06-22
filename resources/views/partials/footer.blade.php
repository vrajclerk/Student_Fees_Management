<footer class=" text-center text-lg-start">
    <div class="container p-4">
        <div class="row">
            <!-- About Section -->
            <div class="col-lg-4 col-md-6 mb-4 mb-md-0">
                <h5 class="text-uppercase"><b>About CEP</b></h5>
                <p>
                    Clerk's Education Point is dedicated to providing top-quality educational resources and services.
                </p>
            </div>
            <!-- Links Section -->
            <div class="col-lg-4 col-md-6 mb-4 mb-md-0">
                <h5 class="text-uppercase"><b>Quick Links</b></h5>
                <ul class="list-unstyled mb-0">
                    <li><a href="/" class=""><b>Home</b></a></li>
                    <li><a href="{{ route('boardmarks.index') }}" class=""><b>Board Marks</b></a></li>
                    {{-- <li><a href="/about" class="text-dark">About</a></li> --}}
                </ul>
            </div>
            <!-- Contact Section -->
            <div class="col-lg-4 col-md-12 mb-4 mb-md-0">
                <h5 class="text-uppercase"><b>About<b></h5>
                <div class="text-center p-3">
                    <p>Design & Developed by <br/>
                        Vraj Clerk  </p>
                </div>
              
            </div>
        </div>
        <div class="text-center p-3">
            <p>&copy; 2024 CLERK'S EDUCATION POINT. All rights reserved.</p>
        </div>
    </div>
</footer>
<style>
/* Footer */
footer {
    background-color: #218838;
    padding: 2rem 0;
    box-shadow: 0 -1px 5px rgb(17, 16, 16);
    margin-top: auto;
}

footer .container {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}

footer .row {
    width: 100%;
    margin: 0 auto;
}

footer h5 {
    color: #050000;
    margin-bottom: 1rem;
}

footer p, footer a, footer ul, footer li {
    color: #feffff;
    font-size: 1rem;
    margin-bottom: 0.5rem;
}

footer a:hover {
    color: #0056b3;
    text-decoration: none;
}

footer .list-unstyled {
    padding-left: 0;
    list-style: none;
}

footer .fab, footer .fas {
    font-size: 1.5rem;
    margin-right: 0.5rem;
}

footer .me-3 {
    margin-right: 1rem !important;
}

footer .text-center p {
    margin: 0;
    color: #f7f8fa;
    font-size: 1rem;
}

@media (max-width: 576px) {
    footer .container {
        flex-direction: column;
    }
    
    footer p, footer a, footer ul, footer li {
        font-size: 0.875rem;
    }

    footer .row {
        flex-direction: column;
        align-items: center;
    }
}
</style>
