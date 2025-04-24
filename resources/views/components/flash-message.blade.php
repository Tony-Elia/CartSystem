@props(['initialMessage' => ''])

<div
    x-data="flashMessage({{ json_encode($initialMessage) }})"
    x-show="visible"
    x-transition
    class="fixed top-[75px] right-4 bg-blue-600 text-white p-4 rounded-lg shadow-lg z-50"
    style="display: none"
>
    <div class="flex justify-between items-center">
        <span x-text="message"></span>
        <button @click="hide" class="ml-4 text-white font-bold">&times;</button>
    </div>
</div>

<script>
    function flashMessage(initialMessage = '') {
        return {
            visible: !!initialMessage,
            message: initialMessage,
            show(newMessage) {
                this.message = newMessage;
                this.visible = true;
                setTimeout(() => this.visible = false, 4000);
            },
            hide() {
                this.visible = false;
            }
        }
    }
</script>
