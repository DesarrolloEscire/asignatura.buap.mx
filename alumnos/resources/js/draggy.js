export default class Draggy {
    constructor(dragContainer, options) {
        
        this.setUp(dragContainer, options)

        
        

    }

    setUp(dragContainer, options){

        this.dragContainer = dragContainer
        this.options = options ?? {}
        this.render()

        this.dragArea = dragContainer.querySelector('.drag-area')

        this.dragContainer.querySelector('#removeInputIcon').addEventListener('click', (event) => {
            this.setUp(dragContainer, options)
        })


        this.selectFileButton().addEventListener('click', event => {
            this.input().click()
        })

        

        this.dragArea.addEventListener('drop', event => {
            event.preventDefault()
            this.showFile(event.dataTransfer.files[0])
        })

        this.dragArea.querySelector('.file-input').addEventListener('change', (event) => {
            const file = this.dragArea.querySelector('.file-input').files[0]
            this.showFile(file)
        })

        this.dragArea.addEventListener('dragover', event => {
            event.preventDefault();
            this.dragArea.style.backgroundColor = "#ffe8e8";
        })

        this.dragArea.addEventListener('dragleave', event => {
            event.preventDefault();
            this.dragArea.style.backgroundColor = "#fff";
        })

        this.dragArea.addEventListener('drop', event => {
            event.preventDefault()

            this.dragArea.querySelector('.file-input').files = event.dataTransfer.files

            this.showFile(event.dataTransfer.files[0])
        })

    }

    selectFileButton() {
        return this.dragArea.querySelector('.select-file-button')
    }

    input() {
        return this.dragArea.querySelector('.file-input')
    }

    render() {
        this.dragContainer.innerHTML = this.dragContainerInnerHTML()
    }

    showFile(file) {

        if (!this.isValidFormat(file)) {
            return
        }

        this.showFileSize(file)
        this.showFileName(file)
        this.showPDFIcon()
        this.hideSelectFileContainer()
    }

    showPDFIcon() {
        this.dragArea.querySelector('.pdf-icon').removeAttribute("hidden")
    }

    hideSelectFileContainer() {
        this.dragArea.querySelector('.select-file-container').style.display = 'none'
    }

    showFileName(file) {
        this.dragContainer.querySelector('.file-name').innerText = file.name
    }

    showFileSize(file) {
        this.dragContainer
            .querySelector('.file-size')
            .innerText = this.bytesToMegaBytes(file.size) + "MB"

    }

    bytesToMegaBytes(size) {
        return (size / 1024 / 1024).toFixed(2);
    }

    fileReaderURL(fileReader) {
        return fileReader.result
    }

    isValidFormat(file) {
        const validFormats = ['application/pdf']
        return validFormats.includes(this.fileFormat(file))
    }

    fileFormat(file) {
        return file.type
    }

    dragContainerInnerHTML() {
        return `
            <i class="fas fa-times text-danger" style="cursor: pointer" id="removeInputIcon"></i>
            <div class="drag-area mb-1">
                <div class="select-file-container">
                    <button type="button" class="btn btn-outline-danger btn-sm select-file-button">
                        <i class="fas fa-solid fa-file-pdf"></i>
                        seleccionar
                    </button> <br>
                    <span><small class="text-danger">arrastra y suelta</small></span>
                    <input type="file" hidden class="file-input" name="${this.options.inputName}"
                        accept="application/pdf">
                </div>
                <i class="fas fa-solid fa-file-pdf pdf-icon text-danger" style="font-size: 90px"
                    hidden></i>
            </div>
            <div class="d-inline-block">
                <small class="file-name"></small>
            </div>
            <div class="d-inline-block float-right">
                <span class="file-size text-info"></span>
            </div>
`
    }
}