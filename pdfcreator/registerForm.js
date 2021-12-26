const fontDescriptors = {
    Roboto: {
        normal: 'fonts/SarabunNew.ttf',
        bold: 'fonts/SarabunNewBold.ttf',
        italics: 'fonts/SarabunNewItalic.ttf',
        bolditalics: 'fonts/SarabunNewBoldItalic.ttf'
    }
}

const pdfPrinter = require('pdfmake')
const printer = new pdfPrinter(fontDescriptors)
const fs = require('fs')

const create = (options, output) => {
    // fs.writeFileSync('data.txt', JSON.stringify(options, null, 2));
    const teams = options.teams.map((team, i) => {
        const teamMembers = team.teamMembers.map((member, i) => {
            return [
                {
                    text: [
                        { text: (i + 1) + '. ชื่อ-สกุล ', style: 'fieldLabel'},
                        { text: member.prefix + member.name + ' ' + member.lastName, style: 'fieldValue'},
                        { text: '   ระดับชั้น ', style: 'fieldLabel'},
                        { text: member.classLevel, style: 'fieldValue'},
                        { text: '   เบอร์โทรศัพท์ ', style: 'fieldLabel'},
                        { text: member.tel, style: 'fieldValue'},
                    ]
                },
                {
                    text: [
                        { text: 'Email ', style: 'fieldLabel'},
                        { text: member.email, style: 'fieldValue'},
                        //{ text: '   Facebook ', style: 'fieldLabel'},
                        //{ text: member.facebook, style: 'fieldValue'},
                    ], margin: [13, 0, 0, 0]
                }
            ]
        })
        return [
            {
                text: [
                    { text: 'ทีม ', style: 'subtitle'},
                    { text: team.teamName, style: 'fieldValue'}
                ]
            },
            ...teamMembers
        ]
    })

    const signatureDot = '.............................................................................................';

    const allMembers = options.teams.reduce((all, team) => {
        return [...all, ...team.teamMembers]
    }, [])

    const teamSignatures = allMembers.map((member, i) => {
        return [
            {
                text: (i + 1) + '. ' + signatureDot,
                style: 'signature'
            },
            {
                text: '(' + member.prefix + member.name + ' ' + member.lastName + ')',
                style: 'signature'
            }
        ]
    })

    const docDefinition = {
        info: {
            title: 'ใบสมัครเข้าร่วมการแข่งขัน SKOI 2019',
            author: 'Suankularb Computer Club'
        },
        pageSize: 'A4',
        content: [
            {
                image: 'SKCC29_LOGO.png', width: 80, alignment: 'center', margin: [0, 0, 0, 16]
            },
            {
                text: 'ใบสมัครเข้าร่วมการแข่งขัน SKOI 2019\nชุมนุมคอมพิวเตอร์ โรงเรียนสวนกุหลาบวิทยาลัย', style: 'header'
            },
            ' ',
            {
                text: [
                    { text: 'โรงเรียน ', style: 'subtitle'},
                    { text: options.schoolName, style: 'fieldValue'}
                ]
            },
            {
                text: [
                    { text: 'อาจารย์ผู้ควบคุมทีม ', style: 'fieldLabel'},
                    { text: options.teacher.name, style: 'fieldValue'},
                    { text: '   เบอร์โทรศัพท์ ', style: 'fieldLabel'},
                    { text: options.teacher.tel, style: 'fieldValue'}
                ]
            },
            ' ',
            // {
            //   text: 'รายชื่อสมาชิกผู้เข้าแข่งขัน', style: 'subtitle'
            // },
            ...teams,
            ' ',
            ' ',
            ' ',
            {
                text: [
                    { text: ' '},
                    { text: '       โรงเรียน อาจารย์ผู้ดูแล และนักเรียนที่ประสงค์เข้าร่วมกิจกรรม ได้ทราบถึงหลักเกณฑ์ในการแข่งขันครั้งน้ีแล้ว ยินดีปฏิบัติตามหลักเกณฑ์ดังกล่าวทุกประการ และขอยอมรับผลการตัดสินของคณะกรรมการโดยไม่มีเง่ือนไข ใด ๆ', style: 'text' }
                ],// , alignment: 'justify'
                // pageBreak: 'before'
            },
            ' ',
            {
                columns: [
                    {
                        width: '*',
                        text: ' '
                    },
                    {
                        width: 'auto',
                        text: '\nลงชื่อนักเรียนผู้สมัคร',
                        style: 'text'
                    },
                    {
                        width: 260,
                        text: [
                          {text:"\n1. .............................................................................................\n",style
:"signature"},{text:"("+ options.teams[0].teamMembers[0].prefix + options.teams[0].teamMembers[0].name + ' ' + options.teams[0].teamMembers[0].lastName +")\n",style:"signature"},
{text:"\n2. .............................................................................................\n",style:
"signature"},{text:"("+ options.teams[0].teamMembers[1].prefix + options.teams[0].teamMembers[1].name + ' ' + options.teams[0].teamMembers[1].lastName +")\n",style:"signature"}
                        ]
                    }
                ]
            },
            {
                columns: [
                    {
                        width: '*',
                        text: ' '
                    },
                    {
                        width: 'auto',
                        text: '\nลงชื่อครูที่ปรึกษา',
                        style: 'text'
                    },
                    {
                        width: 260,
                        text: [
                            {
                                text: '\n'+signatureDot + '.....',
                                style: 'signature'
                            },
                            {
                                text: '(' + options.teacher.name + ')',
                                style: 'signature'
                            }
                        ]
                    }
                ]
            },
            {
                columns: [
                    {
                        width: '*',
                        text: ' '
                    },
                    {
                        width: 'auto',
                        text: '\nลงชื่อผู้รับรอง',
                        style: 'text'
                    },
                    {
                        width: 260,
                        text: [
                            {
                                text: '\n'+signatureDot + '.....',
                                style: 'signature'
                            },
                            {
                                text: '(...' + signatureDot + ')',
                                style: 'signature'
                            },
                            {
                                text: '\nหัวหน้ากลุ่มสาระการเรียนรู้การงานอาชีพและเทคโนโลยี',
                                style: 'signature'
                            }
                        ]
                    }
                ]
            },
            {
                columns: [
                    {
                        width: 50,
                        text: [
                            {
                                text: 'หมายเหตุ', style: 'moreInfo'
                            },
                            {
                                text: ' : ', style: 'boldText'
                            }
                        ]
                    },
                    {
                        width: '*',
                        text: [
                            {
                                text: ' กรุณาส่งใบสมัครเข้าร่วมการแข่งขัน SKOI 2019 ที่ ',
                                style: 'text'
                            },
                            {
                                text: 'computerclub@sk.ac.th ',
                                style: 'boldItalicText'
                            },
                            {
                                text: 'ภายในวันที่ 27 มกราคม 2562 ในกรณีที่ไม่มีลายมือชื่อของสมาชิกผู้เข้าแข่งขันหรืออาจารย์ผู้คุมทีม ถือว่าใบสมัครไม่สมบูรณ์',
                                style: 'boldText'
                            }
                        ]
                    }
                ]
            }
        ],

        styles: {
            header: {
                fontSize: 20,
                bold: true,
                alignment: 'center'
            },
            subtitle: {
                fontSize: 18,
                bold: true
            },
            fieldLabel: {
                fontSize: 16,
                bold: true
            },
            fieldValue: {
                fontSize: 16,
                margin: [ 4, 0 ],
                decoration: 'underline',
                decorationStyle: 'dotted'
            },
            text: {
                fontSize: 16
            },
            boldText: {
                fontSize: 16,
                bold: true
            },
            boldItalicText: {
                fontSize: 16,
                bold: true,
                italics: true
            },
            signature: {
                fontSize: 16,
                alignment: 'center'
            },
            moreInfo: {
                fontSize: 16,
                decoration: 'underline'
            }
        }
    }

    const pdfDoc = printer.createPdfKitDocument(docDefinition)
    // pdfDoc.pipe(fs.createWriteStream('form.pdf'))
    pdfDoc.pipe(output);
    pdfDoc.end()
}

const mockCreate = output => {
    create({
        schoolName: 'สวนกุหลาบวิทยาลัย',
        teacher: {
            name: 'อาจารย์ใจดี ยิ้มอ่อน',
            tel: '088-888-8888'
        },
        teams: [
            {
                teamName: 'Root39',
                teamMembers: [
                    {
                        prefix: 'นาย',
                        name: 'เด็กดี',
                        lastName: 'นิสัยดี',
                        classLevel: 'มัธยมศึกษาปีที่ 5',
                        tel: '089-999-9999',
                        email: 'dekdee@gmail.com',
                        facebook: 'นายเด็กดี นิสัยดี'
                    },
                    {
                        prefix: 'นาย',
                        name: 'เด็กฟีม',
                        lastName: 'นิสัยไม่ดี',
                        classLevel: 'มัธยมศึกษาปีที่ 5',
                        tel: '087-777-7777',
                        email: 'dekcutter@gmail.com',
                        facebook: 'นายเด็กฟีม นิสัยไม่ดี'
                    }
                ]
            },{
                teamName: 'Root38',
                teamMembers: [
                    {
                        prefix: 'นาย',
                        name: 'เด็กไม่ดี',
                        lastName: 'นิสัยไม่ดี',
                        classLevel: 'มัธยมศึกษาปีที่ 5',
                        tel: '089-999-9999',
                        email: 'dekdee@gmail.com',
                        facebook: 'นายเด็กดี นิสัยดี'
                    },
                    {
                        prefix: 'นาย',
                        name: 'เด็กไม่ฟีม',
                        lastName: 'นิสัยดี',
                        classLevel: 'มัธยมศึกษาปีที่ 5',
                        tel: '087-777-7777',
                        email: 'dekcutter@gmail.com',
                        facebook: 'นายเด็กฟีม นิสัยไม่ดี'
                    }
                ]
            }
        ]
    }, output)
}

// module.exports = mockCreate
module.exports = create
