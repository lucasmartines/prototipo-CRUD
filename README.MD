# minha api para gerar vozes em japones para praticar japones

## 🎵 Projeto de Treinamento Laravel - Gerenciador de Músicas com Áudio

Este repositório é parte dos meus estudos práticos sobre arquitetura limpa, Laravel moderno e boas práticas de desenvolvimento backend. A proposta é construir um sistema de gerenciamento de músicas com foco em:

- Criação de **dias** com uma lista de músicas
- Geração de áudio automático a partir de texto usando APIs externas (como ElevenLabs)
- Armazenamento dos arquivos localmente (com UUID e acesso seguro)
- Visualização dos dados com Blade e Tailwind CSS
- Estrutura limpa com Service Layer
- Testes e organização do código conforme princípios SOLID

### ⚙️ Tecnologias Utilizadas

- PHP 8+
- Laravel 12
- SQLite e MySQL
- Tailwind CSS
- ElevenLabs API (voz para texto)
- Laravel Storage (upload seguro)

### 📚 Aprendizados em foco

- ✅ Arquitetura limpa no Laravel
- ✅ Separação de responsabilidades (Controller vs Service)
- ✅ Repository Pattern na prática
- ✅ Testes com dados reais (integração)
- ✅ Upload e geração de arquivos via API externa
- ✅ Deploy e permissões em servidores Bitnami / LightSail
- ✅ Integração com frontend simples via Blade

## 🔧 Como rodar

```bash
git clone https://github.com/seuusuario/nome-do-projeto.git
cd nome-do-projeto
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
