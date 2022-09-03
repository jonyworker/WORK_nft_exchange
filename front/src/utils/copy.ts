import {ElMessage} from 'element-plus'

export const copy = (something: string) => {
    const input = document.createElement('textarea');
    input.setAttribute('display', 'none');
    input.value = something;
    input.setAttribute('value', something);
    document.body.appendChild(input);
    input.select();
    if (document.execCommand('copy')) {
        document.execCommand('copy');
        ElMessage.success({
            showClose: true,
            message: '复制成功',
            center: true
        })
    }
    document.body.removeChild(input);
};