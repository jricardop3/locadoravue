<template>
    <div class="container"> 
    
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Login Vue.JS</div>
                {{email}} - {{password}} 
                <div class="card-body">
                    <form method="POST" action="" @submit.prevent="login($event)">
                    <input type="hidden" name="_token" :value="csrf_token">

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control " name="email" value="" required autocomplete="email" autofocus v-model="email">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Senha</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control " name="password" required autocomplete="current-password" v-model="password">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember">

                                    <label class="form-check-label" for="remember">
                                        Mantenha-me Conectado
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>

                                
                                    <a class="btn btn-link" href="">
                                        Esqueceu a senha?
                                    </a>
                               
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
    export default 
    {
        props:['csrf_token'],
        data(){
            return {
                email: '',
                password: ''
            }
        },
        methods:{
            login(e){
                
                let url = 'http://locadoravue.test/api/login'
                let configuracao = {
                    method: 'post',
                    body: new URLSearchParams({ 
                        'email': this.email, 
                        'password': this.password 
                        })
                }
            fetch(url, configuracao)
                .then(response => response.json())
                .then(data => {
                    if (data.Token) {
                        // Define o cookie com SameSite e Secure (se necessário)
                        document.cookie = `token=${encodeURIComponent(data.token)};SameSite=Lax`
                    }
                    // Envia o formulário apenas se necessário
                    e.target.submit()
                })
                .catch(error => {
                    console.error('Erro na autenticação:', error);
                    // Lógica para tratar erros
                });
        }
    }
}
</script>
