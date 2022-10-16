<template>
  <el-dialog v-model="dialogVisible" title="图片裁剪" width="700px" @close="close">
    <div class="flex align-center justify-between">
      <div class="copper-container">
        <VueCropper
          ref="cropper"
          class="copper-content flex-1 mr-4"
          :img="img"
          :fixed-box="fixedBox"
          :auto-crop="autoCrop"
          :auto-crop-width="autoCropWidth"
          :auto-crop-height="autoCropHeight"
          :center-box="centerBox"
          :can-scale="canScale"
          :output-type="outputType"
          :fixed="true"
          v-bind="$attrs"
          :mode="mode"
          @real-time="realTime"
          @img-load="initScale"
        ></VueCropper>
        <div class="flex items-center justify-between mt-2">
          <div class="btn" @click="changeScale(-1)">-</div>
          <el-slider v-model="slideValue" class="flex-1 ml-5 mr-4" :max="MAX_SCALE" @change="changeSize" />
          <div class="btn" @click="changeScale(1)">+</div>
        </div>
        <div class="flex justify-end">
          <div class="btn" @click="changeRoate()">
            <el-icon class="mt-1"><RefreshRight /></el-icon>
          </div>
        </div>
      </div>
      <div class="preview-container flex flex-col">
        <div class="flex flex-1 align-center justify-between">
          <div class="show-preview overflow-hidden">
            <div :style="fiexdStyle">
              <div :style="previews.div">
                <img :src="previews.url" :style="previews.img" />
              </div>
            </div>
            <p class="absolute text-center">切图预览</p>
          </div>

          <div class="show-preview ml-4 overflow-hidden">
            <div :style="fiexdStyle" class="rounded-full">
              <div :style="previews.div">
                <img :src="previews.url" :style="previews.img" />
              </div>
            </div>
            <p class="absolute text-center">切图预览</p>
          </div>
        </div>
        <div class="flex-1 flex justify-center items-center">
          <el-button @click="close">上一步</el-button>
          <el-button type="primary" class="ml-1" @click="submit">保存</el-button>
        </div>
      </div>
    </div>
  </el-dialog>
</template>

<script setup lang="ts">
  import { ref, watch } from 'vue';
  import 'vue-cropper/dist/index.css'
  import { VueCropper } from 'vue-cropper';
  import { RefreshRight } from '@element-plus/icons-vue';

  interface ImgClipProps {
    visible: boolean;
    /**
     * 图片img
     */
    img: string;
    /**
     * 是否生成截图框
     */
    autoCrop?: boolean;
    /**
     * 固定截图框大小
     */
    fixedBox?: boolean;
    /**
     * 默认生成截图框宽度
     */
    autoCropWidth?: string;
    /**
     * 默认生成截图框高度
     */
    autoCropHeight?: string;
    /**
     * 截图框是否被限制在图片里面
     */
    centerBox?: boolean;
    /**
     *  图片是否允许滚轮缩放
     */
    canScale: boolean;
    /**
     * 图片默认渲染方式
     */
    mode: 'contain' | 'cover' | string;
    /**
     * 裁剪生成图片的格式
     */
    outputType: 'jpeg' | 'png' | 'webp';
  }

  const props = withDefaults(defineProps<ImgClipProps>(), {
    visible: false,
    img: undefined,
    autoCrop: true,
    fixedBox: false,
    autoCropWidth: '120px',
    autoCropHeight: '120px',
    centerBox: true,
    canScale: false,
    mode: 'contain',
    outputType: 'png',
  });

  const dialogVisible = ref(props.visible);
  const previews = ref<Record<string, any>>({});
  const cropper = ref();
  const MAX_SCALE = 50;
  const slideValue = ref<number>(0);
  const oldValue = ref<number>(0);
  const emit = defineEmits(['update:visible', 'save']);
  const fiexdStyle = ref<Record<string, any>>({});

  const realTime = (val: Record<string, any>) => {
    previews.value = val;
    fiexdStyle.value = {
      width: `${val.w}px`,
      height: `${val.h}px`,
      overflow: 'hidden',
      margin: '0',
      zoom: 100 / val.w,
    };
  };

  watch(
    () => props.visible,
    (newVal: boolean) => {
      dialogVisible.value = newVal;
    }
  );

  const changeScale = (num: number) => {
    const str = (slideValue.value <= 0 && num < 0) || (slideValue.value >= MAX_SCALE && num > 0);
    if (str) {
      return;
    }
    const newNum = num ?? 1;
    slideValue.value = slideValue.value + newNum;
    oldValue.value = oldValue.value + newNum;
    cropper.value?.changeScale(newNum);
  };

  const changeSize = (num: number) => {
    const clipNumber = num - oldValue.value;
    oldValue.value = num;
    cropper.value?.changeScale(clipNumber);
  };

  const changeRoate = () => {
    cropper.value?.rotateRight();
  };

  const close = () => {
    emit('update:visible', false);
  };

  const submit = () => {
    cropper.value?.getCropBlob((data: Blob) => {
      emit('save', data);
      close();
    });
  };

  const initScale = () => {
    oldValue.value = cropper.value?.scale ?? 0;
  };

  defineExpose({ cropper });
</script>

<style lang="less" scoped>
  .copper-container {
    width: 380px;
    .copper-content {
      height: 300px;
    }
  }
  .btn {
    text-align: center;
    background-color: #ddd;
    color: var(--wk-color-white);
    width: 20px;
    height: 20px;
    display: inline-block;
    border-radius: 50%;
    line-height: 20px;
    cursor: pointer;
    @extend .action;
  }

  .show-preview {
    width: 120px;
    height: 120px;
    @extend .action;
  }

  .action {
    -webkit-user-select: none;
    -moz-user-select: none;
    -khtml-user-select: none;
    -ms-user-select: none;
    -o-user-select: none;
    user-select: none;
  }
</style>
