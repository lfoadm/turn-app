<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Turn-app - Senha temporária</title>
</head>
<body style="background-color: #f5f7fa; font-family: 'Inter', Arial, sans-serif; margin: 0; padding: 0; -webkit-text-size-adjust: 100%; mso-text-size-adjust: 100%;">

    <!-- Variáveis de Estilo -->
    <!-- Cores: #1D2939 (Principal/Ação), #333333 (Texto Escuro), #666666 (Texto Leve) -->

    <!-- Container Principal (Centralizado) -->
    <div style="max-width: 600px; margin: 0 auto; background: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05); border: 1px solid #e0e6ed;">
        
        <!-- HEADER / Título da Aplicação -->
        <div style="background-color: #1D2939; padding: 20px; text-align: center;">
            <h1 style="color: white; font-size: 24px; margin: 0; letter-spacing: 1px;">Turn-app</h1>
        </div>

        <!-- CORPO DO E-MAIL -->
        <div style="padding: 30px 40px;">
            
            <h2 style="color: #333333; font-size: 22px; margin-top: 0; margin-bottom: 20px; font-weight: 600;">Novo cadastro</h2>
            
            <p style="color: #666666; font-size: 16px; line-height: 1.6; margin-bottom: 20px;">
                Olá, <strong>{{$user->firstname}} {{ $user->lastname }}</strong>, <br/><br/>
            </p>
            <p>Sua conta foi criada no sistema.</p>
            <p>Use este e-mail e a senha temporária para acessar:</p>
            <p><strong>Senha temporária:</strong> {{ $password }}</p>
            <p>Por favor, altere sua senha no primeiro acesso.</p>

            <!-- Aviso de Segurança -->
            <p style="color: #999999; font-size: 14px; text-align: center; border-top: 1px solid #eeeeee; padding-top: 20px; margin-top: 20px;">
                **Segurança:** Se você não solicitou este código ou tentativa de login, por favor, **ignore este e-mail imediatamente**.
            </p>
        </div>

        <!-- FOOTER -->
        <div style="background-color: #e0e6ed; padding: 20px; text-align: center;">
            <p style="color: #888888; font-size: 12px; margin: 0;">
                © 2025 Turn-app. Todos os direitos reservados.
            </p>
        </div>

    </div>

</body>
</html>