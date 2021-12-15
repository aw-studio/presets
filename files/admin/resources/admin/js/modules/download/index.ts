import axios from 'axios';

export const  download = async(url: string, data: object = {}, filename: string) => {
    let response = await axios({
        url,
        method: "POST",
        data,
        responseType: "blob"
    });

    forceFileDownload(response, filename);
};

const forceFileDownload = (response: any, filename: string) => {
    const url = window.URL.createObjectURL(new Blob([response.data]));
    const link = document.createElement("a");
    link.href = url;
    link.setAttribute("download", filename);
    document.body.appendChild(link);
    link.click();
}