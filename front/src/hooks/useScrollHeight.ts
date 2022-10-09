import {onMounted, ref} from "vue";

export const useScrollHeight = () => {
    function getViewHeight() {
        return document.documentElement.clientHeight;
    }

    function getScrollTop() {
        return document.documentElement.scrollTop;
    }

    function getContentHeight() {
        return Math.max(document.body.scrollHeight, document.documentElement.scrollHeight);
    }

    const scrollBtmHeight = ref<number>(0)


    const initScroll = () => {
        window.onscroll = function () {
            // 浏览器可见区域高度为：
            const viewHeight = getViewHeight();
            // 窗口滚动条高度
            const scrollHeight = getScrollTop();
            // 文档内容实际高度：
            const contentHeight = getContentHeight();
            // 滚动条距离底部的高度
            scrollBtmHeight.value = contentHeight - scrollHeight - viewHeight;
            // console.log('浏览器可见区域高度为：' + viewHeight + ' 文档内容实际高度：' + contentHeight + ' 滚动条距离顶部的高度为：' + scrollHeight + ' 滚动条距离底部的高度为：' + scrollBtmHeight.value);
        }
    }
    scrollBtmHeight.value = getViewHeight()
    onMounted(initScroll)
    return {scrollBtmHeight}
}