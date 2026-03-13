<?php
/*
Plugin Name: Chat Widget
Description: Chat widget moderno basado en HTML y php personalizado.
Version: 1.0
Author: dvasquez
Author URI:        https://technoloqie.site/
*/

function chat_widget_custom_assets() {
    wp_enqueue_style('chat-widget-custom-style', plugin_dir_url(__FILE__) . 'assets/style.css');
    wp_enqueue_script('chat-widget-custom-script', plugin_dir_url(__FILE__) . 'assets/scripts.js', array(), null, true);
}
add_action('wp_enqueue_scripts', 'chat_widget_custom_assets');

function render_custom_chat_widget() {
    ob_start(); ?>

    <!-- Botón flotante -->
    <div class="chat-widget" id="chatWidget">
        <button class="social-btn" id="toggleChatBtn">
            <img
                src="assets/image/icon_message.svg"
                alt="chat"
                id="chatWidgetButtonIcon"
                style="width: 51.82px; height: 58px"
            />
        </button>
    </div>

    <!-- Ventana de chat -->
    <div class="chat-container" id="chatContainer" style="display: none;">
        <div class="chat-header">
            <img
                src="assets/image/icon_message.svg"
                alt="chat"
                id="chatHeaderIcon"
                style="width: 33.12px; height: 39px"
            />
            <h1 class="chat-title">Asesor Virtual Inteligente</h1>
            <button class="chat-close" id="closeChatBtn">×</button>
        </div>

        <div class="chat-messages" id="chatMessages">
            <!-- Mensajes se agregan aquí dinámicamente -->
        </div>

        <form class="chat-input-form" id="chatForm">
            <div class="input-wrapper">
                <input
                    type="text"
                    id="messageInput"
                    placeholder="Enviar mensaje"
                    autocomplete="off"
                    name="messageInput"
                />
                <button type="submit">
                    <img
                        src="assets/image/icon_send.svg"
                        alt="Ejecutar"
                    />
                </button>
            </div>
        </form>
    </div>

    <?php
    return ob_get_clean();
}
add_shortcode('tec_chat_widget', 'render_custom_chat_widget');
