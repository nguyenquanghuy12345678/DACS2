/* <script src="https://app.tudongchat.com/js/chatbox.js"></script>
<script>
  const tudong_chatbox = new TuDongChat('fZ9ChXh4rcmZcxj3_79NG')
  tudong_chatbox.initial()
</script> */




// Nạp thư viện chatbox.js từ URL
const script = document.createElement('script');
script.src = "https://app.tudongchat.com/js/chatbox.js";
script.onload = () => {
    // Khởi tạo TuDongChat khi thư viện được tải xong
    const tudong_chatbox = new TuDongChat('fZ9ChXh4rcmZcxj3_79NG');
    tudong_chatbox.initial();
};
document.head.appendChild(script);
