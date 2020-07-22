package com.cristian.dayclass;

import java.io.Serializable;
import java.util.Date;
import java.util.List;
import javax.persistence.Entity;
import javax.persistence.GeneratedValue;
import javax.persistence.GenerationType;
import javax.persistence.Id;
import javax.persistence.ManyToOne;
import javax.persistence.OneToMany;
import javax.persistence.Table;
import javax.persistence.Temporal;


/**
 *
 * @author Cristian
 */
@Entity
@Table(name="ProgramaMateria", schema="dayclass")
public class ProgramaMateria implements Serializable {
    
    private static final long serialVersionUID = 1L;    
    @Id
    @GeneratedValue(strategy=GenerationType.SEQUENCE)
    private int id;
    private int anioPrograma;
    private int cargaHorariaMateria;
    private String descripcionPrograma;
    @Temporal(javax.persistence.TemporalType.DATE)
    private Date fechaVigentePrograma;
    
    @ManyToOne
    private Materia materia;
    
    @OneToMany
    private List<TemasMateria> temasMateria;
    
    public ProgramaMateria(){
        
    }

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public int getAnioPrograma() {
        return anioPrograma;
    }

    public void setAnioPrograma(int anioPrograma) {
        this.anioPrograma = anioPrograma;
    }

    public int getCargaHorariaMateria() {
        return cargaHorariaMateria;
    }

    public void setCargaHorariaMateria(int cargaHorariaMateria) {
        this.cargaHorariaMateria = cargaHorariaMateria;
    }

    public String getDescripcionPrograma() {
        return descripcionPrograma;
    }

    public void setDescripcionPrograma(String descripcionPrograma) {
        this.descripcionPrograma = descripcionPrograma;
    }

    public Date getFechaVigentePrograma() {
        return fechaVigentePrograma;
    }

    public void setFechaVigentePrograma(Date fechaVigentePrograma) {
        this.fechaVigentePrograma = fechaVigentePrograma;
    }

    public Materia getMateria() {
        return materia;
    }

    public void setMateria(Materia materia) {
        this.materia = materia;
    }

    public List<TemasMateria> getTemasMateria() {
        return temasMateria;
    }

    public void setTemasMateria(List<TemasMateria> temasMateria) {
        this.temasMateria = temasMateria;
    }
}  
    
    