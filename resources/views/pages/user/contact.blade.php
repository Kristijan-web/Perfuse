@extends('layouts.user')

@section('title', 'Contact')

@section('content')
    <main class="bg-[#f5f1ea] px-4 py-16 sm:px-6 lg:px-8">
        <section
            class="mx-auto max-w-4xl overflow-hidden rounded-[2rem] border border-black/10 bg-white shadow-[0_30px_80px_rgba(15,23,42,0.12)]">
            <div class="grid lg:grid-cols-[0.95fr_1.05fr]">
                <div class="relative overflow-hidden bg-[#101010] px-8 py-12 text-white sm:px-10 lg:px-12">
                    <div
                        class="absolute inset-0 bg-[radial-gradient(circle_at_top,_rgba(255,255,255,0.18),_transparent_45%)]">
                    </div>
                    <div class="relative space-y-6">
                        <span
                            class="inline-flex rounded-full border border-white/15 bg-white/10 px-4 py-1 text-xs font-semibold uppercase tracking-[0.35em] text-white/70">
                            Kontakt
                        </span>

                        <div class="space-y-4">
                            <h1 class="text-3xl font-semibold tracking-tight sm:text-4xl">
                                Pišite nam bez čekanja.
                            </h1>
                            <p class="max-w-md text-sm leading-7 text-white/70 sm:text-base">
                                Pošaljite naslov i poruku, a naš tim će vam odgovoriti što pre.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="px-8 py-12 sm:px-10 lg:px-12">
                    <form class="space-y-6" id="contact-form">
                        <div class="space-y-2">
                            <label for="contact-title" class="text-sm font-medium text-slate-800">
                                Naslov
                            </label>
                            <input id="contact-title" name="title" type="text" placeholder="Unesite naslov poruke"
                                class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-slate-400 focus:bg-white focus:ring-4 focus:ring-slate-200/70">
                        </div>

                        <div class="space-y-2">
                            <label for="contact-text" class="text-sm font-medium text-slate-800">
                                Tekst
                            </label>
                            <textarea id="contact-text" name="text" rows="8" placeholder="Napišite vašu poruku..."
                                minlength="20"
                                class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-slate-400 focus:bg-white focus:ring-4 focus:ring-slate-200/70"></textarea>
                        </div>
                        <div id="contact-response-container"></div>
                        <button type="submit" id="contact-button"
                            class="inline-flex w-full items-center justify-center rounded-2xl bg-[#101010] px-6 py-3 text-sm font-semibold text-white transition hover:bg-black active:bg-white active:text-black focus:outline-none focus:ring-2 focus:ring-slate-400 focus:ring-offset-2 sm:w-auto">
                            Pošalji poruku
                        </button>
                    </form>
                </div>
            </div>
        </section>
    </main>

    <script>
        const contactForm = document.querySelector('#contact-form');
        const title = document.querySelector('#contact-title')
        const text = document.querySelector('#contact-text');
        const token = document.querySelector('meta[name="csrf-token"]').content;
        const button = document.querySelector('#contact-button');
        const responseContainer = document.querySelector('#contact-response-container');

        const appName = "{{ config('app.url') }}";

        title.addEventListener('input', checkTitleRegex)
        text.addEventListener('input', checkTextLength);

        contactForm.addEventListener('submit', submitForm);


        async function submitForm(e) {
            try {
                e.preventDefault();

                removeMessage(responseContainer); // brise success poruku ako klijent odmah odluci da ponovo submituje novu formu

                const regexChecks = [checkTitleRegex, checkTextLength];

                const runnedRegexChecks = regexChecks.map((regexChecks) => regexChecks())

                if (runnedRegexChecks.includes(false)) return;

                button.textContent = 'Loading...'
                button.disabled = true

                const fetchData = await fetch(`/api/contacts`, {
                    method: "POST",
                    headers: {
                        'Content-type': 'application/json',
                        'X-CSRF-TOKEN': token
                    },
                    body: JSON.stringify({
                        'title': title.value,
                        'text': text.value
                    })
                })

                if (!fetchData.ok || fetchData.status != 201) {
                    throw new Error();
                }

                const response = await fetchData.json();

                console.log("Evo ga response", response);



                displayMessage(responseContainer, "Forma uspesno poslata", 'success');

            } catch {

                displayMessage(responseContainer, "Nesto nije u redu, pokusajte ponovo", 'error')

            } finally {
                button.textContent = 'Pošalji poruku'
                button.disabled = false
            }
        }



        function checkTitleRegex() {

            const titleRegex = /^[A-Z][a-zA-Z]{1,20}$/

            if (!titleRegex.test(title.value)) {

                displayMessage(title, 'Naslov mora poceti velikim slovom i imati barem 2 karaktera', 'error');
                return false;
            }
            else {

                removeMessage(title);
                return true;
            }
        }

        function checkTextLength() {
            if (text.value.length < 20) {

                displayMessage(text, "Forma mora imati najmanje 20 karaktera", 'error');
                return false;
            }
            else {

                removeMessage(text);
                return true;
            }
        }


        function displayMessage(element, message, type = 'error') {

            let messageElement = document.createElement('p');
            messageElement.style.color = type == 'error' ? 'red' : 'green';
            messageElement.style.fontSize = '18px';
            messageElement.textContent = `* ${message}`


            const parentChildrenLength = element.parentElement.children.length;

            if (!(parentChildrenLength == 3)) {
                element.after(messageElement);
            }
        }

        function removeMessage(element) {
            const parent = element.parentElement

            if (parent.querySelector('p')) {
                parent.querySelector('p').remove();
            }
        }


    </script>

@endsection