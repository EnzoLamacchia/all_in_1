<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="theme-color" content="#000000" />
    <link rel="shortcut icon" href="./assets/img/brainOrange.png" />
    <link
      rel="apple-touch-icon"
      sizes="76x76"
      href="./assets/img/apple-icon.png"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/gh/creativetimofficial/tailwind-starter-kit/compiled-tailwind.min.css"
    />
    <title>devELandingPage</title>
  </head>
  <body class="text-gray-800 antialiased">
    <nav
      class="top-0 absolute z-50 w-full flex flex-wrap items-center justify-between px-2 py-3 "
    >
      <div
        class="container px-4 mx-auto flex flex-wrap items-center justify-between"
      >
        <div
          class="w-full relative flex justify-between lg:w-auto lg:static lg:block lg:justify-start"
        >
          <a
              class="text-lg font-bold inline-flex items-end leading-relaxed mr-4 py-2 text-white"
            href="#">
             <img class="w-16" src="/storage/profile-photos/devEL-logoTrasparenteBiancoSoloLogo.png">
              <span style="color: orange;">dev</span>EL Solutions
          </a>
          <button
            class="cursor-pointer text-xl leading-none px-3 py-1 border border-solid border-transparent rounded bg-transparent block lg:hidden outline-none focus:outline-none"
            type="button"
            onclick="toggleNavbar('example-collapse-navbar')"
          >
            <i class="text-white fas fa-bars"></i>
          </button>
        </div>
        <div
          class="lg:flex flex-grow items-center bg-white lg:bg-transparent lg:shadow-none hidden"
          id="example-collapse-navbar"
        >
          <ul class="flex flex-col lg:flex-row list-none lg:ml-auto">
              <li class="flex items-center">
                  <a class="lg:text-white lg:hover:text-gray-300 text-gray-800 px-2 py-3 lg:py-2 flex items-center text-xs uppercase font-bold"
                      href="/login">
                      <img class="sm:hidden w-6" src="./assets/img/login-white.png" alt="login" title="accedi"></img>
                      <span class="lg:hidden inline-block ml-2">Accedi</span>
                  </a>
              </li>
              <li class="flex items-center">
                  <a class="lg:text-white lg:hover:text-gray-300 text-gray-800 px-2 py-3 lg:py-2 flex items-center text-xs uppercase font-bold"
                     href="/register">
                      <img class="sm:hidden w-6" src="./assets/img/registration-white.png" alt="registrati" title="registrati"></img>
                      <span class="lg:hidden inline-block ml-2">Registrati</span>
                  </a>
              </li>
          </ul>
        </div>
      </div>
    </nav>
    <main>
      <div
        class="relative pt-16 pb-32 flex content-center items-center justify-center"
        style="min-height: 75vh;"
      >
        <div
          class="absolute top-0 w-full h-full bg-center bg-cover"
          style='background-image: url("/storage/profile-photos/SfondoDevEL.png");'
        >
          <span
            id="blackOverlay"
            class="w-full h-full absolute opacity-50 bg-black"
          ></span>
        </div>
        <div class="container relative mx-auto">
          <div class="items-center flex flex-wrap">
            <div class="w-full lg:w-6/12 px-4 ml-auto mr-auto text-center">
              <div class="pr-12">
                <h1 class="text-white font-semibold text-5xl">
                  <span style="color: orange;">dev</span>EL Solutions
                </h1>
                <p class="mt-4 text-lg text-gray-300">
                  Inizia con noi la tua web adventure
                </p>
              </div>
            </div>
          </div>
        </div>
        <div
          class="top-auto bottom-0 left-0 right-0 w-full absolute pointer-events-none overflow-hidden"
          style="height: 70px;"
        >
          <svg
            class="absolute bottom-0 overflow-hidden"
            xmlns="http://www.w3.org/2000/svg"
            preserveAspectRatio="none"
            version="1.1"
            viewBox="0 0 2560 100"
            x="0"
            y="0"
          >
            <polygon
              class="text-gray-300 fill-current"
              points="2560 0 2560 100 0 100"
            ></polygon>
          </svg>
        </div>
      </div>
      <section class="pb-0 bg-gray-300 -mt-24">
        <div class="container mx-auto px-4">
          <div class="flex flex-wrap">
            <div class="lg:pt-12 pt-6 w-full md:w-4/12 px-4 text-center">
              <div
                class="relative flex flex-col min-w-0 break-words bg-white w-full mb-8 shadow-lg rounded-lg"
              >
                <div class="px-4 py-5 flex-auto">
                  <div
                    class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 mb-5 shadow-lg rounded-full bg-red-400"
                  >
                    <i class="fas fa-shield-alt text-xl"></i>
                  </div>
                  <h6 class="text-xl font-semibold">Affidabilità</h6>
                  <p class="mt-2 mb-4 text-gray-600">
                    Puoi contare su di noi in ogni fase del progetto.</br>
                    La tua fiducia è il nostro impegno quotidiano.
                  </p>
                </div>
              </div>
            </div>
            <div class="w-full md:w-4/12 px-4 text-center">
              <div
                class="relative flex flex-col min-w-0 break-words bg-white w-full mb-8 shadow-lg rounded-lg"
              >
                <div class="px-4 py-5 flex-auto">
                  <div
                    class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 mb-5 shadow-lg rounded-full bg-blue-400"
                  >
                    <i class="fas fa-thumbs-up text-xl"></i>
                  </div>
                  <h6 class="text-xl font-semibold">Soddisfazione</h6>
                  <p class="mt-2 mb-4 text-gray-600">
                    Ascoltiamo, progettiamo, realizziamo.</br>
                    Il risultato finale è sempre su misura per te.
                  </p>
                </div>
              </div>
            </div>
            <div class="pt-6 w-full md:w-4/12 px-4 text-center">
              <div
                class="relative flex flex-col min-w-0 break-words bg-white w-full mb-8 shadow-lg rounded-lg"
              >
                <div class="px-4 py-5 flex-auto">
                  <div
                    class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 mb-5 shadow-lg rounded-full"
                    style="background-color: #f97316;"
                  >
                    <i class="fas fa-stopwatch text-xl"></i>
                  </div>
                  <h6 class="text-xl font-semibold">Tempestività</h6>
                  <p class="mt-2 mb-4 text-gray-600">
                    Rispettiamo le scadenze, sempre.</br>
                    Il tuo tempo è la nostra priorità.
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <div style="background:#1a202c; line-height:0; margin-top:-20px;">
        <svg xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none" viewBox="0 0 2560 100" style="display:block; width:100%; height:60px; transform:rotate(180deg);">
          <polygon fill="#d1d5db" points="2560 0 2560 100 0 100"></polygon>
        </svg>
      </div>
    </main>
  </body>
  <script>
    function toggleNavbar(collapseID) {
      document.getElementById(collapseID).classList.toggle("hidden");
      document.getElementById(collapseID).classList.toggle("block");
    }
  </script>
</html>
