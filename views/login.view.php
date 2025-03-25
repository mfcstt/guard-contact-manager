<div class="grid grid-cols-[2fr_1fr] min-h-screen">
    <!-- Tela esquerda ocupa mais espaço -->
    <div class="relative flex items-center justify-center bg-cover bg-center" style="background-image: url('/images/background.png');">
        <img src="/images/logo.svg" class="absolute top-10 left-40 transform -translate-x-1/2 w-32">
    </div>

    <!-- Tela direita menor -->
    <div class="bg-[#1B1B1B] hero mr-40 min-h-screen">
        <div class="hero-content -mt-20">
            
            <form method="post" action="/login">
                <a href="/registrar" class="btn btn-link text-white">Não tem uma conta? Criar conta</a>
                <div class="card">

                    <div class="card-body">
                        <p class="text-4xl font-bold text-white">Acessar conta</p>

                        <label class="form-control">
                            <div class="label">
                                <span class="label-text text-white
                            ">Email</span>
                            </div>
                            <input type="email" placeholder="Digite seu e-mail" class="input input-bordered w-full max-w-ws bg-[#1B1B1B] text-[#777777] border-[#777777] border-1 rounded-lg">

                        </label>
                        <label class="form-control">
                            <div class="label">
                                <span class="label-text text-white
                            ">Senha</span>
                            </div>
                            <input type="email" placeholder="Digite sua senha" class="input input-bordered w-full max-w-ws bg-[#1B1B1B] text-[#777777] border-[#777777] border-1 rounded-lg">

                        </label>
                        <div class="card-actions justify-end">
                            <button class="btn btn-primary bg-[#C4F120] btn-block">Acessar conta</button>
                        </div>
                    </div>
                </div>




            </form>

        </div>

    </div>
</div>