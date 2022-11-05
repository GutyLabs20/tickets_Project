<div>
    <label class="switch">
        <input type="checkbox" wire:model="isActive">
        <span class="slider round"></span>
    </label>
</div>
<style>
    .switch{
        position: relative;
        display: inline-block;
        width: 30px;
        height: 17px:
    }
    .switch input{
        opacity: 0;
        width: 0px;
        height: 0px;
    }
    .slider{
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
    }
    .slider:before{
        position: absolute;
        content: "";
        height: 13px;
        width: 13px;
        left: 2px;
        bottom: 2px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }
    input:checked + .slider{
        background-color: #68D391;
    }
    input:focus + .slider{
        box-shadow: 0 0 1px #68D391;
    }
    input:checked + .slider:before{
        -webkit-transform: translateX(13px);
        -ms-transform: translateX(13px);
        transform: translateX(13px);
    }
    .slider.round{
        border-radius: 17px;
    }
    .slider.round:before{
        border-radius: 50%;
    }
</style>
